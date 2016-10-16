#coding=utf-8

import os
import sys

curPath = os.path.abspath(os.path.dirname(__file__))
rootPath = os.path.split(curPath)[0]
sys.path.append(rootPath)

from config.config import Config as config
from android.geek import Geek
from android.gank import Gank
from common.github import GithubTrending
from android.toutiao import Toutiao
from android.androidweekly import AndroidWeekly
from android.cnblogs import Cnblogs
from android.iteye import Iteye
from common.rss_channel import RssChannel
from common.weixin import Weixin

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
        rss = RssChannel(self.conn, "https://www.androiddevdigest.com/feed/", "Android", "Android", "AndroidDevDigest", config.priority_high)
        rss.run()
        rss = RssChannel(self.conn, "https://android-arsenal.com/rss", "Android", "Android", "Android-Arsenal", config.priority_high)
        rss.run()
        # weixin = Weixin(self.conn, "http://mp.weixin.qq.com/profile?src=3&timestamp=1476624231&ver=1&signature=12EpLYsuGUut2p1pCW7VHlz0FlB82QD1VJfVPVN9RUrYlDlQrTXDiGNPH*N0gdtqNYmwukq4WDgJEFSxQ003mw==", "数据库", "数据库", "微信", config.priority_high)
        # weixin.run()
        # weixin = Weixin(self.conn, "http://mp.weixin.qq.com/profile?src=3&timestamp=1476635684&ver=1&signature=3QkYMCqDP2*L3XBY1BABfq92jIQMfvaLQLuEh0vHKpta50WYeRFBSUKm5k9MXLxKDSk8E26ue7-ViYAzJP7b*A==", "Android", "Android", "郭霖-微信公众号", config.priority_high)
        # weixin.run()
        # weixin = Weixin(self.conn, "http://mp.weixin.qq.com/profile?src=3&timestamp=1476635914&ver=1&signature=BOpbVqXaDOTPOrwB*XEVBHQYUtRqur9ln-9xM6Tiskb2Ww4-1hBnvrKOJ5vPzKwbVasoPGPj8ocK5RzQdwO*ig==", "Android", "Android", "鸿洋-微信公众号", config.priority_high)
        # weixin.run()