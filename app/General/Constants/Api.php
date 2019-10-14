<?php
/**
 * Created by patpat.
 * User: Bruce.He
 * Date: 16/4/12
 * Time: 下午4:35
 * Description: PDA API错误CODE
 */

/**
 * Request methord
 */
const g_POST = 'POST';
const g_GET = 'GET';
const g_PUT = 'PUT';
const g_DELETE = 'DELETE';

/*-------- API response key ---------*/
const g_API_STATUS  = 'status';
const g_API_MSG     = 'msg';
const g_API_CONTENT = 'content';

/*-------- API response export format ---------*/
const g_EXPORT_FORMAT_JSON  = 'json';
const g_EXPORT_FORMAT_XML   = 'xml';

/**-------- API system code ---------**/
//Normal
const g_STATUSCODE_OK = 200;

//incorrect parameter
const g_API_ERROR = -1;
//incorrect version
const g_API_VERSIONINVALID = -2;
//system error
const g_API_SYSTEMERROR = -3;
//incorrect signcode
const g_API_SIGNERROR = -4;
//token expired
const g_API_TOKENEXPIRED = 403;
//服务器错误
const g_API_SERVER_ERROR = 1002;
