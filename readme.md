<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>


## 安装

1. 将项目克隆到本地

2. 执行composer命令：composer update -vvv --no-scripts

3.  安装node以及npm

4.  执行npm install;

    如果在windows环境下进行开发，那你要在运行 `npm install` 命令时使用 `--no-bin-links`：

   npm install --no-bin-links5  

5. windows环境下如果执行npm install遇到“cross-env 不是内部或外部命令，也不是可运行的程序问题“异常，请安装cross-env：npm install cross-env --save-dev

6. 安装完成后执行npm run dev，将资源文件复制到public目录下

7. 运行本机域名进行访问