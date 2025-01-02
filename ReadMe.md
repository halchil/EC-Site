# 概要
ECサイトを構築する。

## 利用イメージ

## システムデザイン

## テーブルデザイン

# Deploy

各コンテナに対して個別のDockerfileを作成し、それぞれをビルドして独立したイメージを作る。

```
$ docker build -t my-app ./app
$ docker build -t my-db ./db
```
`--build`オプションは、サービスに関連付けられた Docker イメージを、Dockerfile の定義に基づいて再ビルドするもの。



```
http://xxx.xxx.xxx.xxx:8080
```
へアクセス

# 