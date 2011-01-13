# dinoMbCheckEncodingFilterPlugin

## これは何？
不正なエンコーディングを検出するsymfony用フィルターです。

## Requirement
symfony 1.0

## Install
PROJECT_DIR/plugins/以下に設置したあと、
apps/frontend/config/filters.yml に以下の記述を追加してください。

    dinoMbCheckEncoding:
      class: dinoMbCheckEncodingFilter

