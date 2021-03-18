# Commit Icons

* :art: `:art:` Improving structure / format of the code.
* :zap: `:zap:`  Improving performance.
* :fire: `:fire:` Removing code or files.
* :bug: `:bug:`  Fixing a bug.
* :ambulance: `:ambulance:` Critical hotfix.
* :sparkles: `:sparkles:` Introducing new features.
* :memo: `:memo:` Writing docs.
* :rocket: `:rocket:` Deploying stuff.
* :lipstick: `:lipstick:` Updating the UI and style files.
* :tada: `:tada:` Initial commit.
* :white_check_mark: `:white_check_mark:` Adding tests.
* :lock: `:lock:` Fixing security issues.
* :bookmark: `:bookmark:` Releasing / Version tags.
* :construction: `:construction:` Work in progress.
* :arrow_down: `:arrow_down:` Downgrading dependencies.
* :arrow_up: `:arrow_up:` Upgrading dependencies.
* :wrench: `:wrench:` Changing configuration files.
* :package: `:package:` Updating compiled files or packages.
* :heavy_minus_sign: `:heavy_minus_sign:` Removing a dependency.
* :heavy_plus_sign: `:heavy_plus_sign:` Adding a dependency.


=============================

# Yêu cầu

- NodeJS: version >=6.5 kiểm tra phiên bản hiện tại bằng cách vào terminal gõ `node -v`, nếu dùng phiên bản cũ hơn vui lòng update lên bản mới nhất
- macOS: version >=10.11, nếu dùng phiên bản cũ hơn vui lòng update
- PHPStorm: version >=2016.1, nếu dùng phiên bản cũ hơn vui lòng update

# Khởi tạo

Đầu tiên lấy repo từ trên bitbucket về sau đó mở với PHPStorm, tiếp theo mở Terminal trong PHPStorm và thực thi dòng lệnh `npm install` để hệ thống cài đặt các modules cần thiết.

# Thiết lập PHPStorm

Sau khi cài các node module thì việc tiếp theo là thiết lập PHPStorm, các thư viện, module đã được cài đầy đủ trong bước Khởi tạo nên chúng ta chỉ cần
thiết lập các thông số cho PHPStorm thôi.

0. Cài đặt các plugin cần thiết: editorconfig, scss-lint, cssReorder, .ignore
1. Thiết lập Code Sniffer: nhằm mục đích quản lý chất lượng code PHP theo chuẩn WordPress
![phpcs](dev/images/phpcs.gif)
2. Thiết lập ESlint: nhằm mục đích quản lý chất lượng code JavaScript theo chuẩn WordPress
![eslint](dev/images/eslint.gif)
3. Thiết lập Stylelint: nhằm mục đích quản lý chất lượng code SCSS theo chuẩn WordPress
4. Thiết lập Code style: nhằm mục đích reformat code theo đúng chuẩn WordPress
![eslint](dev/images/codestyle.gif)

# Thay thế

Tiếp theo chúng ta cần tìm và thay thế một số thành phần của theme để phù hợp với yêu cầu của reviewer

1. Thay text domain: Tìm `text_domain` rồi thay bằng tên theme mới ( ví dụ như `tm-heli` )
2. Thay prefix của class: Tìm `Insight` rồi thay bằng tên theme nếu reviewer yêu cầu ( ví dụ như thay `Insight` thành `TM_Heli` )
3. Thay tên thư mục: Thay toàn bộ `thememove` thành tên theme mới. Ví dụ ở đây cần thay 3 thư mục: `thememove -> tm-heli, thememove-child -> tm-heli-child,
thememove-child-demo -> tm-heli-child-demo`

# Các tính năng nổi bật:
1. Tự động hoá các tác vụ dùng Gulp:
	- Tự động tạo file css từ các file scss, dùng lệnh `gulp sass`
	- Tự động tạo file rtl.css từ file style.css, dùng lệnh `gulp rtl`
	- Tự động tạo file language template (.pot), dùng lệnh `gulp pot`
	- Tự động copy thư viện cần thiết dùng bower và thiết lập tại `gulp/config.json`, dùng lệnh `gulp bower:copy`
	- Tự động đóng gói theme va tài liệu hướng dẫn để có thể up lên themeforest ngay, dùng lệnh `gulp envato`
	- Tự động inject css khi sửa file scss, tự động reload khi sửa file php, js, dùng lệnh `gulp`
	- Tự động inject css khi sửa file scss, tự động reload khi sửa file php, js cho child theme, dùng lệnh `gulp default:childDemo`
	- Tự động đẩy file lên host dùng các lệnh: `gulp push:themes`, `gulp push:uploads`, `gulp push:plugins`, `gulp push:data`
	- Tự động đóng gói theme thành file zip chưa đầy đủ document, plugin và sẵn sàng để up lên themeforest
	- Ngoài ra còn có một số tác vụ nhỏ, mọi người tự tìm hiểu trong file `gulpfile.js`
2. Quản lý chất lượng code theo chuẩn WordPress với các thiết lập trong PHPStorm.
3. Quản lý Preset dùng file nên tiện lợi hơn.
3. Framework mạnh, dễ dàng nâng cấp, mở rộng.

# Chức năng các file

```
├── src -> thư mục chứa tất cả các theme
|	└── thememove -> thư mục theme chính
|		├── framework -> thư mục framework
|		|	└── config.json -> file config cho framework
|		└── readme.txt -> file changelog viết cho người dùng
├── gulp -> thư mục các file tác vụ của gulp
|    ├── config.json -> file cấu hình cho gulp
|    └── paths.js -> file cấu hình đường dẫn cho gulp
├── Movefile -> file cấu hình của Wordmove, tại đây developer phải thay đổi các thông số về đường dẫn localhost, remote  host, thông tin db thật chính xác để việc deploy code chuẩn xác
├── README.md -> file hướng dẫn
├── bower.json -> file quản lý package của bower
├── composer.phar -> file composer dùng để cài đặt wpcs
├── gulpfile.js -> file gulp chứa các task tự động hoá
├── package.json -> file quản lý package của Node
├── ruleset.xml -> file cấu hình của phpcs
├── .stylelintrc -> file thiết lập của stylelint
├── .rtlcssrc -> file thiết lập của gulp-rtlcss
├── .editorconfig -> file thiết lập của plugin editorconfig
├── .eslintrc -> file cấu hình của eslint
├── .eslintignore -> file cấu hình của eslint dùng để ignore các file không cần thiết
└── .gitignore -> file cấu hình của git dùng để ignore các file không cần thiết
```
# Lưu ý

Trong thư mục `src` chỉ chứa duy nhất 3 thư mục theme gồm theme chính, theme con và theme con cho mục đích demo, không được
đưa các thư mục khác vào nếu không sẽ làm các tác vụ của gulp bị lỗi

Developer nào không dùng PHPStorm thì tìm các plugin tương ứng với editor của mình. Mục đích cuối cùng là có thể quản lý chất
lượng code theo chuẩn của WordPress.

Developer nào dùng các hệ điều hành không phải macOS trong quá trình cài đặt có vấn đề vui lòng liên hệ Mr Hưng để được trợ giúp

Chúc các đồng chí may mắn!
