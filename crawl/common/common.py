import pytz
import datetime
import time

class Common(object):

    @staticmethod
    def getDate():
        tz = pytz.timezone('Asia/Shanghai')
        date = datetime.datetime.now(tz)
        datestr = date.strftime("%Y-%m-%d")
        return datestr

    @staticmethod
    def getTime():
        tz = pytz.timezone('Asia/Shanghai')
        date = datetime.datetime.now(tz)
        datestr = date.strftime("%H时%M分")
        return datestr

    def updateLastTime(connection):
        try:
            with connection.cursor() as cursor:
                sql = "REPLACE into `config` set `val`=%s, `name`=%s"

                cursor.execute(sql, (Common.getTime(), 'last_time'))

                connection.commit()
                print("sql:" + sql)
        except Exception as e:
            print(str(e))
            connection.rollback()

    @staticmethod
    def insertInfoToDb(connection, title, summary, link, category, tag, source, priority):
        # check link data
        try:
            with connection.cursor() as cursor:
                sql = "SELECT * from `feed` where `link` = %s";
                cursor.execute(sql, (link));
                result = cursor.fetchone();
                if (result is not None) and (len(result) > 0) :
                    print("重复数据：" +  title)
                    return
        except Exception as e:
            print(str(e))

        # insert data
        try:
            with connection.cursor() as cursor:
                sql = "INSERT INTO `feed` (`title`, `summary`, `time`, `link`, `category`, `tag`, `source`, `priority`, `created`)" \
                      + " VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)"
                if (len(category) == 0):
                    if ("java" in title.lower()) or ("android" in title.lower()):
                        category = "Android"
                    elif ("swift" in title.lower()) or ("xcode" in title.lower()) or "objective" in title.lower():
                        category = "iOS"
                    else:
                        category = "Unknow"

                cursor.execute(sql, (title, summary, Common.getDate(), link, category, tag, source, priority, int(time.time())))
                connection.commit()
                print("最新数据：" + title)
        except Exception as e:
            print(str(e))
            connection.rollback()
