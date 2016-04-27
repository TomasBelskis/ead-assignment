# ead-assignment
EAD ASSIGNMENT SPECIFICATION
============================

##EAD Assignment, requirements list Installability/Portability  

[0] the web-application is not portable at all, and cannot be configured due to hard-coded strings 

[1] the web-application can be installed in another machine, but significant effort is required for configuration or updating

[2] the web-application can be installed on another machine correctly and intuitively with minimal effort.

##Testability (TDD)  

[0] no functional code has been tested

[1] sporadic use of tests (some function tested partially) 

[2] all the functions have been tested in the most appropriate way (covering all the possible inputs and behaviours)

##MVC-correctness  

[0] the MVC pattern has not been adopted at all 

[1] the MVC pattern has been employed but in the wrong way (eg. wrong interaction of components, or assignment of wrong responsibilities to the components) 

[2] the MVC pattern has been sufficiently employed but with some arguable choice (eg. decisions assigned to the controller rather than to the model or the view) 

[3] the MVC pattern has been correctly employed and each component does what it is supposed to do pdo DB manager and DAOs objects  

##DAOs

[0] DAO objects have not been used at all 

[1] an attempt to create DAO exists 

[2] different DAOs have been created for different entities (eg. artists, songs, etc) and most of them work 

[3] different DAOs have been created for different entities (eg. users, books, etc) and they all work. 

##DRY principle  

[0] several blocks of code have been repeated several times 

[1] some blocks of code could be better optimised and repetition avoided 

[2] code is well written and never repeated (eg. good use of classes, methods, constants)

##Authentication  

[0] an authentication mechanism is not present 

[1] an attempt to build the authentication middleware is present but not working 

[2] the authentication middleware is present and working 

##Response formats 

[0] plain text has been used for returning responses 

[1] just one response format has been implemented (eg. json) 

[2] at least 2 response formats have been implemented (json, xml) 

##Response HTTP codes  

[0] http response codes are not set/returned at all 

[1] response codes are partially set/returned 

[2] response codes are always set/returned for every scenario ROUTES and CRUD operations (at least over 2 db tables)  1 point for each route implemented (GET/POST/PUT/DELETE) (max 8 points) 

##Extra functionality 

[1] point awarded for an extra functionality implemented by student
