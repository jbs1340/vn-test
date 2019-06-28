<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt,
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define('WP_CACHE', true);
#define( 'WPCACHEHOME', 'C:\xampp\htdocs\wordpress\wp-content\plugins\wp-super-cache/' );
define( 'DB_NAME', 'vietnam_bycnit' );

/** Username của database */
define( 'DB_USER', 'vnbycnit' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', 'IT@dmin#456' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'ws-{>f,r(iiwU1|fz}oDb^MY]5B==t!vQrI}3mHc2hN- 94G*tbP-qvtSx~PS;SG' );
define( 'SECURE_AUTH_KEY',  'QI`+`paJ3bX&kwk3B:]CplE7^qgykf9`H]}X%Y$o?|KQBWu>$Pe$^DVr.q}:d9+f' );
define( 'LOGGED_IN_KEY',    'mk@^}?tX<@_Dc(:*3]SI3rfRrz{],;o AsGxw&rfbHTGx#VtiGF)z,qg4K4|.ll^' );
define( 'NONCE_KEY',        '}w`@cs]<2%{kb{<=92&&i1}Vc&-2 >9^RPp;BVA8,J EMN`@!7*l`%F3F6&0<El[' );
define( 'AUTH_SALT',        'vGX^0>Itl5~E1NYYTOTp{3E| Zt#@6FZ2L](Xw0(i]5j rN/nACyus0A2I^Tr8h,' );
define( 'SECURE_AUTH_SALT', 'uzF/- k)?23P:LOY$)>5AZ/=1*WxFzyb mm@!T#1:|+^e~A#_J,yT}:vk3(s`5sq' );
define( 'LOGGED_IN_SALT',   ')mc9qn&54mCSq`LzXmk5Z--_z>~U}(^C}+i[U[?A!&9.OKK~gU@Rn26t<_u(M]~G' );
define( 'NONCE_SALT',       'p}gVf-_,gRcS;W&i+Os?~B@hhh(* 6s#mI40dk]lX$io11}jc0[_W^@+m8B(7b+Y' );

#define('WP_PROXY_HOST', '10.117.71.4');
#define('WP_PROXY_PORT', '8080');

define("WP_LOGIN_AUTH_TOKEN", "mc9qn54mCSq");

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'db_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
