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

class AndroidBlogs:
    def __init__(self, conn):
        self.conn = conn

    def run(self):
        print("start 技术小黑屋 ... ...")
        rss = RssChannel(self.conn, "http://droidyue.com/atom.xml", "Android", "Android", "技术小黑屋", config.priority_high)
        rss.run()
        print("end 技术小黑屋 ... ...")
        print("start 高爷 ... ...")
        rss = RssChannel(self.conn, "http://androidperformance.com/atom.xml", "Android", "Android", "高爷", config.priority_high)
        rss.run()
        print("end 高爷 ... ...")
        print("start 高爷 ... ...")
        rss = RssChannel(self.conn, "https://drakeet.me/feed", "Android", "Android", "Drakeet的个人博客", config.priority_high)
        rss.run()
        print("end 高爷 ... ...")
        print("start 吴小龙同学 ... ...")
        rss = RssChannel(self.conn, "http://wuxiaolong.me/atom.xml", "Android", "Android", "吴小龙同学", config.priority_high)
        rss.run()
        print("end 吴小龙同学 ... ...")
        print("start liangzhitao 同学 ... ...")
        rss = RssChannel(self.conn, "http://www.easydone.cn/atom.xml", "Android", "Android", "liangzhitao", config.priority_high)
        rss.run()
        print("end liangzhitao 同学 ... ...")
        print("start 张涛同学 ... ...")
        rss = RssChannel(self.conn, "http://kymjs.com/rss", "Android", "Android", "张涛", config.priority_high)
        rss.run()
        print("end 张涛同学 ... ...")
