<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<title>乐至技术资讯平台</title>
		<script src="//cdn.bootcss.com/jquery/3.1.0/jquery.js"></script>
		<link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/0.4.3/weui.min.css" />
		<link rel="stylesheet" href="css/main.css" />
		<style type="text/css">
			#bottom_space {
				height: 80px;
			}
		</style>
	</head>

	<body ontouchstart>
		<?php
			$mysql_server_name='localhost'; //改成自己的mysql数据库服务器
			$mysql_username='root'; //改成自己的mysql数据库用户名
			$mysql_password='<db_password>'; //改成自己的mysql数据库密码
			$mysql_database='TechInfo'; //改成自己的mysql数据库名

			$conn=@mysql_connect($mysql_server_name,$mysql_username,$mysql_password) or die("error connecting") ; //连接数据库

			mysql_query("set names 'utf8'"); //数据库输出编码 应该与你的数据库编码保持一致.南昌网站建设公司百恒网络PHP工程师建议用UTF-8 国际标准编码.

			mysql_select_db($mysql_database); //打开数据库

			$today = date("Y-m-d",time());
			$last_time = "不知道";

			$sql ="select * from config where name = 'last_time'"; //SQL语句
			$result = mysql_query($sql,$conn); //查询
			while($row = mysql_fetch_array($result)) {
				$last_time = $row["val"];
			}
		?>
		<div class="weui_tab_bd">
			<div class="hd">
				<h1 class="page_title">乐至技术资讯平台</h1>
				<p class="page_desc">积小流化江海，为技术加油！(更新于<?php echo $last_time ?>)</p>
			</div>

					<div id="home_ios_container" class="weui_panel weui_panel_access tab_hide">
						<div class="weui_panel_hd">iOS、Swift、iOS开发(<?php echo $today ?>)</div>
						<div class="weui_panel_bd">
							<?php
								$sql ="select * from infos where time = '" . $today . "'  and category in ('iOS', 'Swift', 'iOS开发') order by id desc"; //SQL语句
								$result = mysql_query($sql,$conn); //查询
								while($row = mysql_fetch_array($result))
								{
									if (empty($row["title"])) {
										continue;
									}
									echo "<a href=\"" . $row["link"] . "\" target=\"_blank\" class=\"weui_media_box weui_media_appmsg\">";
									echo "<div class=\"weui_media_hd\"><img onclick=\"itemActionMore(this)\" class=\"weui_media_appmsg_thumb\" src=\"http://www.atool.org/placeholder.png?size=120x120&text=" . $row["source"] . "&&bg=AB3F49&fg=fff\"></div>";
									echo "<div class=\"weui_media_bd\">";
									echo "<h4 class=\"weui_media_title\">" . $row["title"] ."</h4>";
									echo "<p class=\"weui_media_desc\">" . $row["summary"] . "</p>";
									echo "</div>";
									echo "</a>";
								}
							?>
						</div>
						<a class="weui_panel_ft" href="javascript:void(0);">加载下一页</a>
					</div>
		</div>
	</body>
</html>
