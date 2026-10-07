# UNITRADES

UNITRADES is a premium crypto trading dashboard and user-management prototype with shared login, registration, and admin controls.

## Local development

```bash
cd C:\Users\user\Desktop\broker
node server.js
```

Open:

```text
http://localhost:3000
```

## Public deployment

This project is designed for a Node web service, not static GitHub Pages hosting.

Recommended platform: Render

1. Push this repository to GitHub.
2. Open Render and click New -> Web Service.
3. Connect your GitHub repository.
4. Use the following values:
   - Environment: Node
   - Build command: `npm install`
   - Start command: `node server.js`
   - Add env vars:
     - `NODE_ENV=production`
     - `PORT=10000`
     - `DATA_DIR=/var/data`

Render will mount the persistent disk defined in `render.yaml`, which keeps the user database alive across deploys and restarts.

## Notes

- This app uses a shared JSON data store so users and admin data can be seen across devices and browsers.
- The admin login is:
  - Email: `admin@unitrades.com`
  - Password: `admin123`
- For real-world trading platforms, this should be upgraded with a database like PostgreSQL, password hashing, and a secure admin system.
