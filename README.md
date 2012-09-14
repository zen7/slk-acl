SlkAcl
====

This is a simple ZF2 module implementing an Access Control List module.

Requirements
----

* PHP >= 5.3.3
* Zend Framework 2.0.0 or later, specifically:
* Modules:
	zfc-base
	zfc-user
    
Installation
----

Install the module by cloning it into ./vendor/ and enabling it in your
application.config.php file.

You will need to configure the following:

* Database for the user
	- use the zf-common/zfc-user/data/schema*.sql files
* Alter the table to add the role field. The SQL can look like:
	ALTER TABLE user ADD role varchar(50) DEFAULT NULL;  

* Setup the database connection. You can use the config/database.local.php.dist file as a start.

If you want to improve this module or have additional questions write me at: slavey [a t] zend {dot} com

License
----

Copyright (c) 2012, Slavey Karadzhov
All rights reserved.

Redistribution and use in source and binary forms, with or without modification,
are permitted provided that the following conditions are met:

* Redistributions of source code must retain the above copyright notice, this
  list of conditions and the following disclaimer.

* Redistributions in binary form must reproduce the above copyright notice, this
  list of conditions and the following disclaimer in the documentation and/or
  other materials provided with the distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR
ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
