<?php
/* database constants */
define("DB_HOST", "localhost" ); 		// set database host
define("DB_USER", "root" ); 			// set database user
define("DB_PASS", "" ); 				// set database password
define("DB_PORT", 3306);				// set database port
define("DB_NAME", "DIT" ); 			// set database name
define("DB_CHARSET", "utf8" ); 			// set database charset
define("DB_DEBUGMODE", true ); 			// set database charset

/* actions for the USERS REST resource */
define("ACTION_GET_USER", 33);
define("ACTION_GET_USERS", 44);
define("ACTION_CREATE_USER", 55);
define("ACTION_UPDATE_USER", 66);
define("ACTION_DELETE_USER", 77);
define("ACTION_SEARCH_USERS", 88);
define("ACTION_AUTHENTICATE_USER", 99);
define("ACTION_GET_BOOK", 35);
define("ACTION_GET_BOOKS", 46);
define("ACTION_CREATE_BOOK", 57);
define("ACTION_UPDATE_BOOK", 68);
define("ACTION_DELETE_BOOK", 79);
define("ACTION_SEARCH_BOOKS", 81);

/* actions for the Publisher REST resource */
define("ACTION_GET_PUBLISHER", 34);
define("ACTION_GET_PUBLISHERS", 45);
define("ACTION_CREATE_PUBLISHER", 56);
define("ACTION_UPDATE_PUBLISHER", 67);
define("ACTION_DELETE_PUBLISHER", 78);
define("ACTION_SEARCH_PUBLISHER", 89);

/* HTTP status codes 2xx*/
define("HTTPSTATUS_OK", 200);
define("HTTPSTATUS_CREATED", 201);
define("HTTPSTATUS_NOCONTENT", 204);

/* HTTP status codes 3xx (with slim the output is not produced i.e. echo statements are not processed) */
define("HTTPSTATUS_NOTMODIFIED", 304);

/* HTTP status codes 4xx */
define("HTTPSTATUS_BADREQUEST", 400);
define("HTTPSTATUS_UNAUTHORIZED", 401);
define("HTTPSTATUS_FORBIDDEN", 403);
define("HTTPSTATUS_NOTFOUND", 404);
define("HTTPSTATUS_REQUESTTIMEOUT", 408);
define("HTTPSTATUS_TOKENREQUIRED", 499);

/* HTTP status codes 5xx */
define("HTTPSTATUS_INTSERVERERR", 500);

define("TIMEOUT_PERIOD", 120);

/* general message */
define("GENERAL_MESSAGE_LABEL", "message");
define("GENERAL_SUCCESS_MESSAGE", "success");
define("GENERAL_ERROR_MESSAGE", "error");
define("GENERAL_NOCONTENT_MESSAGE", "no-content");
define("GENERAL_NOTMODIFIED_MESSAGE", "not modified");
define("GENERAL_INTERNALAPPERROR_MESSAGE", "internal app error");
define("GENERAL_CLIENT_ERROR", "client error: modify the request");
define("GENERAL_INVALIDTOKEN_ERROR", "Invalid token");
define("GENERAL_APINOTEXISTING_ERROR", "Api is not existing");
define("GENERAL_RESOURCE_CREATED", "Resource has been created");
define("GENERAL_RESOURCE_UPDATED", "Resource has been updated");
define("GENERAL_RESOURCE_DELETED", "Resource has been deleted");

define("GENERAL_FORBIDDEN", "Request is ok but action is forbidden");
define("GENERAL_INVALIDBODY", "Request is ok but transmitted body is invalid");

define("GENERAL_WELCOME_MESSAGE", "Welcome to DIT web-services");
define("GENERAL_INVALIDROUTE", "Requested route does not exist");


/* representation of a new user in the DB */
define("TABLE_USER_NAME_LENGTH", 25);
define("TABLE_USER_SURNAME_LENGTH", 25);
define("TABLE_USER_EMAIL_LENGTH", 50);
define("TABLE_USER_PASSWORD_LENGTH", 40);


/* representation of a new publisher in the DB*/
define("TABLE_PUBLISHER_LENGTH", 150);
define("TABLE_PUBLISHER_ADDRESS_LENGTH", 100);
define("TABLE_PUBLISHER_PHONE_LENGTH", 12);
define("TABLE_BOOK_TITLE_LENGTH", 60);

?>