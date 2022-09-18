# 原油先物取引者向けの原油データアプリ

## 作った意図
株、為替取り引き向けのデータは多くあるのに、原油取り引き向けのデータまとめたWebサイトやアプリは多くありません。そのため原油先物取り引き者向けのWebアプリを作成することにしました。

# デプロイ手順
apache2.4の確認
コンポーザーをインストール
$ composer install
.env.exampleを.envとしてコピーして各種設定
npm インストール＆ビルド
$ npm install 
$ npm run dev

各ディレクトリ・ファイルの権限をアパッチからアクセスできるようにグループを持ったrootからユーザに変更すること



## 開発環境
* php 7.3
* laravel
* mysql 5.7
* vue
* apache 2.4
* node 12.22.12
* npm 7.5.2
* Docker


## APIでEIAからデータをデータベースに自動で入れるやり方
1. 指定の時間にAPIをたたく (ex 0;00に一回)
2. 5つほどづつデータを取得
3. データベースの最新のデータの日付と比較
4. 最新の日付より新しいデータがあれば格納



## データの取得方法
1. 時間になったらcronでAPIをたたく
2. APIでデータを取得
3. データをDBに格納
4. DBから値を取得
5. 表示

## EIAのAPIからデータを取得する方法
$ php artisan api:insert AREA PRODUCT PROCESS START_DATE END_DATE
実例)
$ php artisan api:insert R10 EPC0 SAX 2000-01-01


## どのデータを取得するか？
EIA
weekly petroleum status report 毎週水曜１０：３０
* crude oil
* total motor gasoline
* distillate fuel oil

## 外部API
### API
https://qiita.com/shuta_takeuchi/items/e2f45eb4966deb3d3de5
### EIA API
https://www.eia.gov/opendata/documentation.php

## database table
* ending stocks
* period duoarea area-name product product-name process process-name series series-description value units


## デプロイ時の問題

###ext-dom 問題
$ sudo apt install php-xml

### permision
storege を読み書き可能に