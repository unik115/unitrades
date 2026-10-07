const test = require('node:test');
const assert = require('node:assert/strict');
const { createServer } = require('../server.js');

async function request(server, method, path, body) {
  const payload = body ? JSON.stringify(body) : undefined;
  const res = await fetch(`http://127.0.0.1:${server.address().port}${path}`, {
    method,
    headers: payload ? { 'Content-Type': 'application/json' } : undefined,
    body: payload
  });

  const text = await res.text();
  return {
    status: res.status,
    body: text ? JSON.parse(text) : null,
    text
  };
}

test('register and login share the same user data store', async () => {
  const server = createServer();
  await new Promise((resolve) => server.listen(0, resolve));

  try {
    const reg = await request(server, 'POST', '/api/register', {
      firstName: 'Shared',
      lastName: 'User',
      email: 'shared@example.com',
      password: 'secret123',
      gender: 'Male',
      country: 'Nigeria',
      currency: 'USD'
    });

    assert.equal(reg.status, 201);
    assert.equal(reg.body.user.email, 'shared@example.com');

    const login = await request(server, 'POST', '/api/login', {
      email: 'shared@example.com',
      password: 'secret123'
    });

    assert.equal(login.status, 200);
    assert.equal(login.body.user.email, 'shared@example.com');

    const list = await request(server, 'GET', '/api/users');
    assert.equal(list.status, 200);
    assert.ok(Array.isArray(list.body.users));
    assert.ok(list.body.users.some((user) => user.email === 'shared@example.com'));
  } finally {
    await new Promise((resolve, reject) => server.close((err) => (err ? reject(err) : resolve())));
  }
});
