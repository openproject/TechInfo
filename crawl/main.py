# coding=utf-8
import pymysql.cursors
import time

import sys
import os

curPath = os.path.abspath(os.path.dirname(__file__))
rootPath = os.path.split(curPath)[0]
sys.path.append(rootPath)
from common.common import Common as common
from android.android import Android
from config.config import Config as config

if __name__ == "__main__":
    global connection
    connection = pymysql.connect(host=config.db_host,
                                 user=config.db_user,
                                 password=config.db_password,
                                 db=config.db_name,
                                 charset='utf8mb4',
                                 cursorclass=pymysql.cursors.DictCursor)

    print("======================================================")
    print("================" + common.getDate() + " " + common.getTime() + "=============")
    print("======================================================")
    print("###############开始抓取Android模块##################")
    android = Android(connection)
    android.run()
    print("###############结束抓取Android模块##################")

    # 更新时间
    common.updateLastTime(connection)

    connection.close()
