# Hardwire Mailgun FROM address.

If the constant `MAILGUN_FROM_ADDRESS`is set, this plugin will hardwire the from address to the value of `MAILGUN_FROM_ADDRESS`.

The[ WordPress Mailgun plugin](https://github.com/mailgun/wordpress-plugin) set the address resolution order in this order:
 1. From address given by headers - {@param $from_addr_header}
 2. From address set in Mailgun settings
 3. From `MAILGUN_FROM_ADDRESS` constant
 4. From address constructed as `wordpress@<your_site_domain>`

So, if 1 or 2 above is true, the from address will not be set by the `MAILGUN_FROM_ADDRESS` constant

 > https://github.com/mailgun/wordpress-plugin/blob/9da7978246a3983159c8577c1ac09cedc075a2da/includes/mg-filter.php#L142-L148

This filter will override these and use the MAILGUN_FROM_ADDRESS constant.

The plugin will also hardwire the email from address and from name for Ninja Forms.


## Installation

You know the drill.


## Copyright and License

Hardwire Mailgun FROM address. is copyright 2021 Per Soderlind

Hardwire Mailgun FROM address. is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or (at your option) any later version.

Hardwire Mailgun FROM address. is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU Lesser General Public License along with the Extension. If not, see http://www.gnu.org/licenses/.