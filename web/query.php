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
		<div class="page">
			<div class="page__hd">
				<h1 class="page_title">技术资讯开放平台</h1>
				<p class="page_desc">聚焦最新Android资讯(<?php echo $yesterday ?>)</p>
			</div>
			<div class="page__bd">
				<div class="weui-search-bar" id="searchBar">
					        <form class="weui-search-bar__form">
					            <div class="weui-search-bar__box">
					                <i class="weui-icon-search"></i>
					                <input type="search" class="weui-search-bar__input" id="searchInput" placeholder="搜索" required/>
					                <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
					            </div>
					            <label class="weui-search-bar__label" id="searchText">
					                <i class="weui-icon-search"></i>
					                <span>搜索</span>
					            </label>
					        </form>
					        <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
					    </div>
				   </div>

				   <div id="search_result_container" class="weui-panel weui-panel_access">
					<div class="weui-panel__hd">搜索結果</div>
					<div class="weui-panel__bd" id="search_result_list">
				</div>
			</div>

			<br />
			<br />
			<br />
			<div class="weui-footer">
				<p class="weui-footer__links">
					<a href="https://github.com/openproject/TechInfo" class="weui-footer__link">搜索</a>
					<a href="http://www.jayfeng.com" class="weui-footer__link">杰风居出品</a>
					<a href="https://github.com/openproject/TechInfo" class="weui-footer__link">Github</a>
				</p>
				<p class="weui-footer__text">Copyright &copy; 20015-2016 jayfeng.com</p>
			</div>

<script type="text/javascript">

    $(function(){

        var $searchBar = $('#searchBar'),

            $searchResult = $('#searchResult'),

            $searchText = $('#searchText'),

            $searchInput = $('#searchInput'),

            $searchClear = $('#searchClear'),

            $searchCancel = $('#searchCancel');



        function hideSearchResult(){

            $searchResult.hide();

            $searchInput.val('');

        }

        function cancelSearch(){

            hideSearchResult();

            $searchBar.removeClass('weui-search-bar_focusing');

            $searchText.show();

        }



        $searchText.on('click', function(){

            $searchBar.addClass('weui-search-bar_focusing');

            $searchInput.focus();

        });

        $searchInput

            .on('blur', function () {

                if(!this.value.length) cancelSearch();

            })

            .on('input', function(){

                if(this.value.length) {

                    $searchResult.show();

                } else {

                    $searchResult.hide();

                }

            })

        ;

        $searchClear.on('click', function(){

            hideSearchResult();

            $searchInput.focus();

        });

        $searchCancel.on('click', function(){

            cancelSearch();

            $searchInput.blur();

        });

    });

</script>
	</body>
</html>
