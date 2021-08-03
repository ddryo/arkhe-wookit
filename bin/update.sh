#!/bin/bashx

#使い方 : $ bash ./bin/update.sh 0-2-2

#引数 : プラグインのバージョン
version=$1

#上の階層へ
cd ..

#zプラグインファイルをzip化
zip -r arkhe-wookit.zip arkhe-wookit -x  "*/.*" "*/__*" "*/bin*" "*/node_modules*" "*/vendor*" "*/src/*" "*gulpfile.js" "*README.md" "*phpcs.xml"

#設定ファイル系削除
zip --delete arkhe-wookit.zip  "arkhe-wookit/composer*" "arkhe-wookit/webpack*" "arkhe-wookit/package*"

#zipファイルを移動
mv arkhe-wookit.zip ./arkhe-cdn/arkhe-wookit-${version}.zip
