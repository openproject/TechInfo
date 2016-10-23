<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title>技术资讯开放平台</title>
		<script src="//cdn.bootcss.com/jquery/3.1.0/jquery.js"></script>
		<link rel="stylesheet" href="css/weui.min.css" />
		<link rel="stylesheet" href="css/main.css" />
		<style type="text/css">
			#bottom_space {
				height: 80px;
			}
		</style>
	</head>

	<body ontouchstart>
        <?php
            error_reporting(E_ALL);
            ini_set( 'display_errors', 'On' );
        ?>
		<?php
			require_once 'common/Utils.php';
			$utils = new Utils();

			$mysql_server_name='localhost'; //改成自己的mysql数据库服务器
			$mysql_username='root'; //改成自己的mysql数据库用户名
			$mysql_password='<db_password>'; //改成自己的mysql数据库密码
			$mysql_database='TechInfo'; //改成自己的mysql数据库名

			$conn=@mysql_connect($mysql_server_name,$mysql_username,$mysql_password) or die("error connecting") ; //连接数据库

			mysql_query("set names 'utf8'"); //数据库输出编码 应该与你的数据库编码保持一致.南昌网站建设公司百恒网络PHP工程师建议用UTF-8 国际标准编码.

			mysql_select_db($mysql_database); //打开数据库

			$yesterday = date("Y-m-d",time() - 3600*24);
		?>
		<div class="weui-tab_bd">
			<div class="hd">
				<h1 class="page_title">技术资讯开放平台</h1>
				<p class="page_desc">聚焦最新Android资讯(历史更多)</p>
			</div>

			<div id="home_android_container" class="weui-panel weui-panel_access tab_hide">
			<div class="weui-panel__hd">昨日推荐(
					<?php
						echo $yesterday;
					?>
					)
			</div>
			<div class="weui-panel__bd">
			<?php
				$sql ="select * from feed where time = '" . $yesterday . "' and priority=1 and (tag like '%Android%' or tag like '%Java%') order by id desc"; //SQL语句
				$result = mysql_query($sql,$conn); //查询
				while($row = mysql_fetch_array($result))
				{
					if (empty($row["title"])) {
						continue;
					}
					echo "<a href=\"" . $row["link"] . "\" target=\"_blank\" class=\"weui-media-box weui-media-box_appmsg\">";
					echo "<div class=\"weui-media-box__bd\">";
					echo "<h4 class=\"weui-media-box__title\">" . $row["title"] ."</h4>";
					echo "<p class=\"weui-media-box__desc\">" . $row["summary"] . "</p>";
					echo "<ul class=\"weui-media-box__info\">";
					echo "    <li class=\"weui-media-box__info__meta\">" . $utils->getWellTimeByTimestamp($row["created"]) ."</li>";
					echo "    <li class=\"weui-media_text_info__meta weui-media_text_info__meta_extra\">" . $row["source"]. "</li>";
					echo "</ul>";
					echo "</div>";
					echo "</a>\n";
				}
			?>
			</div>
		</div>
			<?php
				include("footer.php");
			?>
	</body>
</html>
