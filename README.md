# ahc001

## 1日目

### 12:01:49
とりあえずスペース1個で提出。当然WA

### 12:34:59 -- 823090
ACはしときたいので、面積1の看板で提出。ACする。

### 13:08:21 -- WA
幅を伸ばしてさらに高さを伸ばすコードを書くがWAを頂いてしまう。

家族で遅めの外食と買い物にでる。

### 15:47:24 -- 4417512130
高さ方向に伸ばすコードが怪しいので、幅だけ伸ばすパターンでACを手堅く回収。

### 16:17:30 -- WA
高さを伸ばすコードを入れて壊す。通るテストケースと落ちるテストケースがあり検証が厄介なので、50個のテストケースを一括実行する仕組みを作る。

### 16:47:39 -- 38549192026
縦方向にも伸ばすコードが通る。愚直解として最低限やることはやった感じになった。

### 17:17:56 -- 38628287710
縦方向に伸ばす際の面積計算を、幅の半分だけずらす。※伸ばして損をするべきではない。

### 18:28:29 -- 38771115728
面積の小さな看板から設置する。※面積の小さな看板のほうが小さな改善で得点を向上できるため

### 18:58:29 -- 38810403141
面積の最終調整は幅で行う。　※幅＞高さなので、幅で調整したほうが正確な調整ができる。

### 19:58:20 -- 39351515329
縦横ひっくり返して2通りの解を求めて良い方を採択する。
・複数回実行できるように関数化
・どちらが良いか評価するために得点計算を実装

### 20:29:12 -- 39351515392
幅を微調整（0.5ずらした）

1日目よるの時点での積み残し
- 上下に伸ばしているが、どちらから伸ばすかで結果が違うはずで、良い方をすることで改善が見込める。
- 伸ばす処理を高速化することで、より多くのロジックを詰め込める可能性がある
- 縦横片方の軸でしか分割していないが、両方の軸で分割したほうがよい場合もあるはず。

## 2日目

### 12:06:35	
上に伸ばすパターンと下に伸ばすパターンを両方試して良い方を回答する

### 12:39:29
伸ばす順序を広告ごとに乱択する

### 14:14:05
処理を高速化し乱択回数を増やす

## 3日目
何もせず

## 4日目

### 実装案
どちらもそんなに良くなさそうだけど既存の方法と組み合わせれば点数あがりそう？450億点は超えたい。
- 基準点から膨らませていく方法
- 横をＫ個に割って処理する方法（２＜Ｋ＜５ぐらい？）

