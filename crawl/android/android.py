#coding=utf-8

import os
import sys

curPath = os.path.abspath(os.path.dirname(__file__))
rootPath = os.path.split(curPath)[0]
sys.path.append(rootPath)
from android.geek import Geek
from android.gank import Gank
from common.github import GithubTrending
from android.toutiao import Toutiao
from android.androidweekly import AndroidWeekly
from android.cnblogs import Cnblogs
from android.iteye import Iteye

class Android:
    def __init__(self, conn):
        self.conn = conn

    def run(self):
        print("开始抓取gank数据...")
        gank = Gank(self.conn)
        gank.start_basic_list()
        print("抓取gank数据结束。")
        print("start geek ... ...")
        geek = Geek(self.conn)
        geek.start_basic_list()
        print("end geek ... ...")
        print("start toutiao ... ...")
        toutiao = Toutiao(self.conn)
        toutiao.start_basic_list()
        print("end toutiao ... ...")
        print("start github for java... ...")
        github_java = GithubTrending(self.conn)
        github_java.start_basic_list('java', 'Java')
        print("end github for java ... ...")
        print("start AndroidWeekly ... ...")
        androidweekly = AndroidWeekly(self.conn)
        androidweekly.start_basic_list()
        print("end AndroidWeekly ... ...")
        print("start Cnblogs ... ...")
        cnblogs = Cnblogs(self.conn)
        cnblogs.start_basic_list()
        print("end Cnblogs ... ...")
        print("start Iteye ... ...")
        iteye = Iteye(self.conn)
        iteye.start_basic_list()
        print("end Iteye ... ...")
