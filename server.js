const http = require('http');
const fs = require('fs');
const path = require('path');

const DATA_DIR = process.env.DATA_DIR || path.join(__dirname, 'data');
const FILE_PATH = path.join(DATA_DIR, 'users.json');
const staticRoot = __dirname;

function ensureDataFile() {
  try {
    fs.mkdirSync(DATA_DIR, { recursive: true });
    if (!fs.existsSync(FILE_PATH)) {
      const adminUser = {
        id: 'admin-1',
        firstName: 'Admin',
        lastName: 'Control',
        email: 'admin@unitrades.com',
        password: 'admin123',
        role: 'admin',
        gender: 'Prefer not to say',
        country: 'United States',
        currency: 'USD',
        dashboard: {
          balance: 450000,
          profit: 180000,
          positions: 14,
          winRate: 81.4,
          btcWatch: 86890,
          ethWatch: 3560,
          recentActivity: ['Market desk update | 30 mins ago', 'Admin allocation review | 2 hours ago']
        },
        createdAt: new Date().toISOString()
      };

      fs.writeFileSync(FILE_PATH, JSON.stringify({ users: [adminUser] }, null, 2));
    }
  } catch (error) {
    console.error('Failed to initialize user data:', error);
  }
}

function safeJsonParse(value, fallback) {
  try {
    return JSON.parse(value || 'null') ?? fallback;
  } catch (error) {
    return fallback;
  }
}

function readUsers() {
  try {
    ensureDataFile();
    const raw = fs.readFileSync(FILE_PATH, 'utf8');
    const parsed = safeJsonParse(raw, { users: [] });
    return Array.isArray(parsed.users) ? parsed.users : [];
  } catch (error) {
    return [];
  }
}

function writeUsers(users) {
  ensureDataFile();
  fs.writeFileSync(FILE_PATH, JSON.stringify({ users }, null, 2));
}

function normalizeEmail(value) {
  return String(value || '').trim().toLowerCase();
}

function dedupeUsers(users) {
  const merged = new Map();

  users.forEach((user) => {
    const email = normalizeEmail(user.email);
    if (!email) return;

    const existing = merged.get(email);
    if (!existing) {
      merged.set(email, { ...user, email });
      return;
    }

    merged.set(email, {
      ...existing,
      ...user,
      email,
      role: user.role || existing.role || 'user',
      dashboard: user.dashboard || existing.dashboard || {
        balance: 0,
        profit: 0,
        positions: 0,
        winRate: 0,
        btcWatch: 0,
        ethWatch: 0,
        recentActivity: ['No recent activity']
      }
    });
  });

  return Array.from(merged.values());
}

function sendJson(res, statusCode, payload) {
  res.writeHead(statusCode, { 'Content-Type': 'application/json; charset=utf-8', 'Access-Control-Allow-Origin': '*', 'Access-Control-Allow-Methods': 'GET,POST,PUT,DELETE,OPTIONS', 'Access-Control-Allow-Headers': 'Content-Type' });
  res.end(JSON.stringify(payload));
}

function sendFile(res, filePath) {
  fs.readFile(filePath, (error, content) => {
    if (error) {
      res.writeHead(404);
      res.end('Not found');
      return;
    }

    const ext = path.extname(filePath).toLowerCase();
    const types = {
      '.html': 'text/html; charset=utf-8',
      '.css': 'text/css; charset=utf-8',
      '.js': 'application/javascript; charset=utf-8',
      '.json': 'application/json; charset=utf-8',
      '.svg': 'image/svg+xml',
      '.png': 'image/png',
      '.jpg': 'image/jpeg',
      '.jpeg': 'image/jpeg',
      '.ico': 'image/x-icon'
    };

    res.writeHead(200, { 'Content-Type': types[ext] || 'application/octet-stream' });
    res.end(content);
  });
}

function buildUserResponse(user) {
  return {
    id: user.id || user.email,
    firstName: user.firstName || '',
    lastName: user.lastName || '',
    email: user.email || '',
    role: user.role || 'user',
    gender: user.gender || 'Prefer not to say',
    country: user.country || 'United States',
    currency: user.currency || 'USD',
    dashboard: user.dashboard || {
      balance: 0,
      profit: 0,
      positions: 0,
      winRate: 0,
      btcWatch: 0,
      ethWatch: 0,
      recentActivity: ['No recent activity']
    },
    createdAt: user.createdAt || new Date().toISOString()
  };
}

function handleApi(req, res) {
  const url = new URL(req.url, 'http://localhost');

  if (req.method === 'OPTIONS') {
    sendJson(res, 200, { ok: true });
    return true;
  }

  if (req.method === 'GET' && url.pathname === '/api/users') {
    const users = dedupeUsers(readUsers()).map(buildUserResponse);
    sendJson(res, 200, { users });
    return true;
  }

  if (req.method === 'POST' && url.pathname === '/api/register') {
    let body = '';
    req.on('data', (chunk) => { body += chunk; });
    req.on('end', () => {
      const payload = safeJsonParse(body, {});
      const email = normalizeEmail(payload.email);
      const users = dedupeUsers(readUsers());

      if (!payload.firstName || !payload.lastName || !email || !payload.password) {
        sendJson(res, 400, { error: 'Required fields are missing.' });
        return;
      }

      if (users.some((user) => normalizeEmail(user.email) === email)) {
        sendJson(res, 409, { error: 'This email is already registered.' });
        return;
      }

      const newUser = {
        id: `user-${Date.now()}-${Math.random().toString(16).slice(2, 8)}`,
        firstName: payload.firstName,
        lastName: payload.lastName,
        email,
        password: payload.password,
        gender: payload.gender || 'Prefer not to say',
        country: payload.country || 'United States',
        currency: payload.currency || 'USD',
        role: 'user',
        dashboard: {
          balance: 0,
          profit: 0,
          positions: 0,
          winRate: 0,
          btcWatch: 0,
          ethWatch: 0,
          recentActivity: ['No recent activity']
        },
        createdAt: new Date().toISOString()
      };

      users.push(newUser);
      writeUsers(users);
      sendJson(res, 201, { message: 'User created', user: buildUserResponse(newUser) });
    });
    return true;
  }

  if (req.method === 'POST' && url.pathname === '/api/login') {
    let body = '';
    req.on('data', (chunk) => { body += chunk; });
    req.on('end', () => {
      const payload = safeJsonParse(body, {});
      const email = normalizeEmail(payload.email);
      const password = String(payload.password || '');

      const users = dedupeUsers(readUsers());
      const foundUser = users.find((user) => normalizeEmail(user.email) === email && String(user.password || '') === password);

      if (!foundUser) {
        sendJson(res, 401, { error: 'Invalid email or password.' });
        return;
      }

      sendJson(res, 200, {
        message: 'Login successful',
        user: buildUserResponse(foundUser)
      });
    });
    return true;
  }

  if (req.method === 'PUT' && url.pathname.startsWith('/api/users/')) {
    const email = decodeURIComponent(url.pathname.split('/api/users/')[1]);
    let body = '';
    req.on('data', (chunk) => { body += chunk; });
    req.on('end', () => {
      const payload = safeJsonParse(body, {});
      const users = dedupeUsers(readUsers());
      const index = users.findIndex((user) => normalizeEmail(user.email) === normalizeEmail(email));

      if (index === -1) {
        sendJson(res, 404, { error: 'User not found.' });
        return;
      }

      users[index] = { ...users[index], ...payload, email: normalizeEmail(users[index].email), dashboard: payload.dashboard || users[index].dashboard };
      writeUsers(users);
      sendJson(res, 200, { message: 'User updated', user: buildUserResponse(users[index]) });
    });
    return true;
  }

  return false;
}

function createServer() {
  return http.createServer((req, res) => {
    const url = new URL(req.url, 'http://localhost');

    if (req.method === 'OPTIONS') {
      sendJson(res, 200, { ok: true });
      return;
    }

    if (url.pathname.startsWith('/api/')) {
      if (handleApi(req, res)) return;
      sendJson(res, 404, { error: 'API route not found.' });
      return;
    }

    const safePath = url.pathname === '/' ? '/index.html' : url.pathname;
    const resourcePath = path.join(staticRoot, safePath);

    if (!resourcePath.startsWith(staticRoot)) {
      res.writeHead(403);
      res.end('Forbidden');
      return;
    }

    fs.stat(resourcePath, (error, stats) => {
      if (error || !stats.isFile()) {
        const fallback = path.join(staticRoot, 'index.html');
        sendFile(res, fallback);
        return;
      }

      sendFile(res, resourcePath);
    });
  });
}

if (require.main === module) {
  ensureDataFile();
  const port = Number(process.env.PORT || 3000);
  const server = createServer();
  server.listen(port, () => {
    console.log(`UNITRADES server running on http://localhost:${port}`);
  });
}

module.exports = { createServer, normalizeEmail, dedupeUsers, readUsers, writeUsers };
