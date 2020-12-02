@extends('navbar')

@section('custom_css')
    <style>
        .tds{
            border: 1px solid gray;
            padding: 8px;
        }
    </style>

@stop


@section('content')
    <div class=" row" style="padding-top: 28px">
        <div class="col-md-12 alternates" style="max-width: 650px !important">
            <div class="col-md-12 col-sm-12 text-left;">
                <div style="overflow-x:auto;">
                    <table style="width: 98%; min-width: 500px">
                        <tbody>
                            <tr>
                                <td colspan="2" style="border: none"><span>資金決済法に基づく表記</span></td>
                            </tr>
                            <tr>
                                <td class="tds" style="width: 30%">■   商号</td>
                                <td class="tds">株式会社いいとも</td>
                            </tr>
                            <tr>
                                <td class="tds">■   前払式支払手段の 支払可能金額等</td>
                                <td class="tds">上限はありません。<br/>1 有償ポイント=1 円</td>
                            </tr>
                            <tr>
                                <td class="tds">■   有効期間</td>
                                <td class="tds">発行を受けた日から 180 日</td>
                            </tr>
                            <tr>
                                <td class="tds">■   お問い合わせ先</td>
                                <td class="tds">
                                    <div>東京都板橋区南常盤台 1-11-6 レフア南常盤台 101 号室</div>
                                    <div>株式会社いいとも カスタマーサポート</div>
                                    <div>no1salespeco@gmail.com</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="tds">■   使用することができる施設 または場所の範囲</td>
                                <td class="tds">「スマートーク」サービス内</td>
                            </tr>
                            <tr>
                                <td class="tds">■   利用上の注意点</td>
                                <td class="tds">
                                    <div>原則として、有償ポイントの払い戻しはいたしません。</div>
                                    <div>ただし、当社が有償ポイントを廃止する場合または、法令により定</div>
                                    <div>められた場合にはこの限りではありません。</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="tds">■   未使用残高確認方法</td>
                                <td class="tds">
                                <div>当社 WEB サイト「スマートーク」内の残高画面にて残高確認でき</div>
                                <div>ます。</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="tds">■   規約</td>
                                <td class="tds">「利用規約」をご確認ください。</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop



@section('custom_js')

@stop