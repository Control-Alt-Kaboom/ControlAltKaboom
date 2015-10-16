# ControlAltKaboom - About

A simple web site/application kick-starter. Its basically a simple/stripped-down framework that contains many of the commonly required components for both production and development environments. This package is primarily a private codebase and is not written or designed with any intent to support the public, however its freely available for anyone who feels they can use it. 


> With that said, there should be an understanding of liability and support - There is none.


## Installation Requirements

> This package relies on [composer](https://getcomposer.org/) for installation. Aside from just being an easy way to get things going, it resolves many dependancies and creates the autoloading feature that the package as a whole requires.

For a complete installation and configuration how-to, see [InstallAndConfigure.md](./InstallAndConfigure.md)


## Whats Included

The following table represents the included components, their development state, and links to their respected packages and documentation


| Component | Description | State | Version | Source | Tests | Docs |
| --------- | ----------- | ----- | ------- | ------ | ----- | ---- |
| AppBase\Common | A set of helper functions for common tasks | dev | 0.1 | [src](../src/AppBase/Common) | [tests](../tests/AppBase/Common) | [docs](./AppBase_Common.md) |
| AppBase\Control | A set of methods used for simple api/tpl parsing | dev | 0.1 | [src](../src/AppBase/Control) | [tests](../tests/AppBase/Control) | [docs](./AppBase_Control.md) |
| AppBase\Debug | A set of methods used for debugging | dev | 0.1 | [src](../src/AppBase/Debug) | [tests](../tests/AppBase/Debug) | [docs](./AppBase_Debug.md) |
| Database | MySQL Database Abstraction and Data-Model Base-Classes | dev | 0.1 | [src](../src/Database) | [tests](../tests/Database) | [docs](./Database.md) |
| EventRegistry| Event Registration and Dispatching Handlers | dev | 0.1 | [src](../src/EventRegistry) | [tests](../tests/EventRegistry) | [docs](./EventRegistry.md) |
| Exceptions | Exception Handlers and Templates  | dev | 0.1 | [src](../src/Exception) | [tests](../tests/Exception) | [docs](./Exceptions.md) |
| ModelViewController | A simple stripped down MVC Framework | dev | 0.1 | [src](../src/ModelViewController) | [tests](../tests/ModelViewController) | [docs](./ModelViewController.md) |
| Sessions | A simple DB-Session management class | dev | 0.1 | [src](../src/Sessions) | [tests](../tests/Sessions) | [docs](./Sessions.md) |
| Sockets | Allows for listenting and dispatching to web sockets | dev | 0.1 | [src](../src/Sockets) | [tests](../tests/Sockets) | [docs](./Sockets.md) |
| scripts\backup| Bash-Based file and database backup script. | dev | 0.1 | [src](../scripts/backup) |  | [docs](../scripts/backup/README.md) |



