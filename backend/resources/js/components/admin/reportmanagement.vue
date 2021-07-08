<template>
<div class="container-fluid">
    <div class="fade-in mb-3">
        <div class="row">
            <div class="col-lg-12">
                <button class="btn btn-primary" type="button">今日</button>
                <button class="btn btn-secondary ml-2" type="button" disabled="">昨日</button>
                <button class="btn btn-square btn-secondary rounded-left ml-2" type="button" disabled="">
                    <</button> <button class="btn btn-square btn-secondary rounded-right" type="button" disabled="">>
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-align-justify"></i>2021年6月22日（火）の報告</div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>アカウント名</th>
                                <td>報告の有無</td>
                                <td>ピンポン数（件）</td>
                                <td>対面数（件）</td>
                                <td>商談数（件）</td>
                                <td>獲得数（件）</td>
                                <td>成約率（％）</td>
                                <td>稼働時間（時間）</td>
                                <td>生産性（件/時間）</td>
                                <td>今日意識した点</td>
                                <td>報告時間</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>赤坂 次郎</th>
                                <td>2012/01/01</td>
                                <td>10</td>
                                <td>10</td>
                                <td>10</td>
                                <td>1</td>
                                <td>10</td>
                                <td>10</td>
                                <td>10</td>
                                <td>稼働時間とピンポン数に意識してみた</td>
                                <td>2021-06-22 23:23</td>
                            </tr>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">
                                    <</a> </li> <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h5>指標毎の営業マン成績</h5>
            <button class="btn btn-outline-primary" type="button">ピンポン数</button>
            <button class="btn btn-outline-primary ml-2" type="button">成約率</button>
            <button class="btn btn-outline-primary ml-2" type="button">総獲得数</button>
            <button class="btn btn-outline-primary ml-2" type="button">生産性</button>
        </div>
    </div>
</div>
</template>

<script>
export default {

}
</script>

<style>
.table th,
.table td {
    padding: 0.3rem;
}
</style>
