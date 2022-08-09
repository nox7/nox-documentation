# Nox Documentation
Nox is a small, lightweight PHP framework that revolves around MVC architecure. Nox takes inspiration from Java Spring Boot with file structure and organization. By utilizing the power of PHP 8 and 8.1, you'll be breaking into a new, modern era of PHP programming.

Nox makes no attempts to be a full-service web framework, but instead serves to assist in creating your own apps and projects by being a skeleton to canvas your custom flair onto. With native PHP attribute routing, there is no need to have a route registry file - you can keep your project tight and object-oriented. Simply create a class and public methods with routes that return a stringable result.

Nox **is not** a web server and is currently only compatible with Apache web servers. The primary compatibility restriction comes from using the Apache config (.htaccess) file for route directing. Theoretically, this can be done on Nginx by forwarding requests similarly to how the default Apache config file in Nox does.

## Documentation Notes
Throughout some of this documentation, full code examples won't be used. In some cases, they will be code stubs that should go into a fuller picture. For example, sometimes a class method will be shown but not the actual class definition or `use` statements surrounding it.