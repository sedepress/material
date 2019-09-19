<?php
namespace App\Libs;

class StatusCode
{
    /**
     * API正确请求
     */
    const SUCCESS = 200;//get、post正确
    const CREATED = 201; //创建成功

    /**
     * API 错误请求
     */
    const BAD_REQUEST = 400; //错误请求
    const UNAUTHORIZED = 401; //未登录
    const TOKEN_EXPIRED = 401001; //token超时
    const TOKEN_INVALID = 401002; //token失效
    const REQUEST_PARAMS_NOT_VALID = 402; //参数不完整或错误
    const FORBIDDEN  = 403;   //权限不足
    const RESOURCE_NONE = 410; //目标资源不存在
    const RESOURCE_CONFLICT = 409; //目标资源已存在，不可新增
    const RESOURCE_LOCKED = 423; //目标资源不可编辑
    const INTERNAL_SERVER_ERROR  = 500;           //系统繁忙
}
