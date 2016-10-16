from urllib.request import urlopen
from bs4 import BeautifulSoup as bs
import re
import pymysql.cursors
from common.common import Common as common
from config.config import Config as config

from selenium import webdriver
from selenium.webdriver.common import by


class Weixin(object):
    def __init__(self, conn, url, category, tag, source, priority):
        self.conn = conn
        self.url = url
        self.category = category
        self.tag = tag
        self.source = source
        self.priority = priority

    def run(self):
        dr = webdriver.PhantomJS('phantomjs')
        dr.get(self.url)

        cards = dr.find_elements_by_class_name('weui_msg_card')
        print(dr)
        print(dr.title)
        for card in cards:

            titleTarget = card.find_element_by_class_name("weui_media_title")
            title = titleTarget.text
            link = "http://mp.weixin.qq.com" + titleTarget.get_attribute("hrefs")

            print(link)
            print(title)

            common.insertInfoToDb(self.conn, title, "", link, self.category, self.tag, self.source, self.priority)
        dr.quit()
