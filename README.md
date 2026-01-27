<p align="center">
  <img src="img/logo-nobk.png" width="200">
</p>

# Linky
**Linky** is a modern, elegant web application designed to manage your personal or organization's links in a grouped and orderly way.

## ✨ Features
- **Modern & Responsive UI**: Clean design built with Laravel, Tailwind CSS, and the Inter font.
- **🌗 Dark Mode Support**: Full support for light and dark themes with persistent user preference.
- **📁 Group Management**: Organize links into logical groups for easy navigation.
- **🔓 Public Links**: Mark specific links or entire groups as public to share them without a login.
- **🎲 Random Redirection**: Visit a random link from a group using `/group/{id}/random`.
- **🔗 Short Codes**: Access links directly via custom redirect codes (e.g., `/r/code`).
- **💡 Global Variables**: Define variables (like `@{{VAR}}`) to use as shortcuts in your link URLs.
- **🐳 Docker Ready**: Get up and running in seconds with a containerized environment (Laravel + SQLite + Nginx).

## 📸 Screenshots
<table style="width: 100%">
  <tr>
    <td><strong>Variables</strong><br><img src="img/1.png"></td>
  </tr>
  <tr>
    <td><strong>Link Management</strong><br><img src="img/2.png"></td>
  </tr>
  <tr>
    <td><strong>Public Page</strong><br><img src="img/4.png"></td>
  </tr>
</table>

# How to use

**1. Clone repository**
```shell
$ git clone https://github.com/trebsoj/linky.git
```

**2. Configuration file**

Creation of the configuration file from the example .env.example,
in this file you can configure the database parameters and the application port

```shell
$ cp .env.example .env
```

**3. Start the application**

```shell
$ make up
```

3.1. If it is the **first execution**, execute this command to initialize the application

```shell
$ make init
```

# How to
### Open the shell in the container?

Execute in your terminal:

```shell
$ make sh-app
```
```shell
$ make sh-nginx
```

### Watch logs?

```shell
$ docker-compose logs -f
```
