<div id="div-step-1">
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="m-t-0 m-b-30 header-title">Step 1 : Crawling</h4>
                <hr>
                <form role="form" action="#" id="fr-step-1">
                    <div class="form-group">
                        <label for="komentar">Pilih Kata Kunci Komentar</label>
                        <select name="komentar" id="komentar" class="form-control">
                            <option value="harga telkomsel">Harga Telkomsel</option>
                            <option value="internet telkomsel">Internet Telkomsel</option>
                            <option value="jaringan telkomsel">Jaringan Telkomsel</option>
                            <option value="kenyamanan telkomsel">Kenyamanan Telkomsel</option>
                            <option value="layanan telkomsel">Layanan Telkomsel</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group step-1-lainnya" style="display: none;">
                        <label for="komentar">Masukan Kata Kunci Komentar</label>
                        <input type="text" id="komentar-lainnya" class="form-control" autocomplete="off">
                    </div>

                    <button id='submit-step-1' class="btn btn-success">
                        <i class="mdi mdi-play"></i> <span class="span-step-1"> RUN</span>
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
<div id="div-step-2" style="display: none">

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="m-t-0 m-b-30 header-title">Step 2 : Sentiment Analysist
                    <span class="step-2-judul text-primary"></span>
                </h4>
                <hr>
                <div class="table-responsive ">
                    <table class="table table-bordered display" id="table-step-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Username</th>
                                <th>Tweet</th>
                                <th>Tweet Clean</th>
                                <th>Sentiment</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>

                <button class="btn btn-success mt-3" id="submit-step-2">
                    <i class=" mdi mdi-file-document-outline"></i> <span class="span-step-2"> Summary</span>
                </button>

            </div>
        </div>
    </div>

</div>
<div id="div-step-3" style="display: none;">
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="m-t-0 m-b-30 header-title">Step 3 : Summary
                    <span class="step-2-judul text-primary"></span>
                </h4>
                <hr>

                <h4 class="header-title m-t-0 m-b-30">Summary Chart</h4>

                <div id="pie-chart">
                    <div id="pie-chart-container" class="flot-chart" style="height: 260px;">
                    </div>
                </div>

                <button class="btn btn-success mt-3 mr-2" id="submit-step-3">
                    <i class="  mdi mdi-content-save-outline"></i> <span class="span-step-3"> Save to Database</span>
                </button>

                <button class="btn btn-info mt-3" id="new-step-3">
                    <i class="mdi mdi-new-box"></i> New Analysist
                </button>

                <div class="alert alert-success alert-dismissable text-danger text-center font-bold mt-3" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Data berhasil disimpan !.
                </div>

            </div>
        </div>
    </div>


</div>

<!-- hoisting  -->
<script>
    var summary, persen, datadb
</script>

<!-- step 1  -->
<script>
    $('select#komentar').change(function() {
        let komentar = $(this).val()
        let divLainnya = $('div.step-1-lainnya')
        let komentarLainnya = $('input#komentar-lainnya')

        if (komentar == 'lainnya') {
            divLainnya.show()
            komentarLainnya.prop('required', true)
        } else {
            divLainnya.hide()
            komentarLainnya.prop('required', false)
        }
    })

    $('form#fr-step-1').submit(function(e) {
        e.preventDefault()

        let tmp_komentar = $('select#komentar').val()
        let keyword
        summary = {
            'positif': 0,
            'negatif': 0,
            'netral': 0
        }

        if (tmp_komentar == 'lainnya') {
            keyword = $('input#komentar-lainnya').val()
        } else {
            keyword = tmp_komentar
        }

        $.ajax({
            url: "<?= base_url('realtime/ajax_step_1') ?>",
            method: 'post',
            data: {
                keyword
            },
            dataType: 'json',
            beforeSend: function() {
                $('span.span-step-1').text('Running').prev().prop('class', 'mdi mdi-run')
                $('span.step-2-judul').text('')

            },
            success: function(res) {
                // console.log(res);
                if (res.length !== 0) {
                    let data = []
                    let no = 1
                    $.each(res, function(key, val) {

                        let sentiment

                        if (val.sentiment == 'positif') {
                            sentiment = `<span class='text-success font-bold'>${val.sentiment}</span>`
                            summary.positif = summary.positif + 1
                        } else if (val.sentiment == 'negatif') {
                            sentiment = `<span class='text-danger font-bold'>${val.sentiment}</span>`
                            summary.negatif = summary.negatif + 1
                        } else {
                            sentiment = `<span class='text-primary font-bold'>${val.sentiment}</span>`
                            summary.netral = summary.netral + 1
                        }

                        let tmp = [
                            no++,
                            val.date,
                            `<a href="https://twitter.com/${val.username}/status/${val.id_tweet}" target='_blank'>${val.username}</a>`,
                            val.tweet,
                            val.tweet_clean,
                            sentiment,
                            val.skor
                        ]
                        data.push(tmp)
                    });

                    $('div#div-step-2').show()
                    $('div#div-step-3').hide()
                    runDatatable('#table-step-2', data)

                    $("html, body").delay(500).animate({
                        scrollTop: $('#div-step-2').offset().top
                    }, 500);


                } else {
                    $("#table-step-2").DataTable().clear().draw();
                    $('div#div-step-2').hide()
                    alert(`Tweet terkait kata Kunci '${keyword}' tidak ditemukan. Coba gunakan kata kunci lainnya !`);
                }

                $('span.step-2-judul').text(`(${keyword})`)
                $('span.span-step-1').text('RUN').prev().prop('class', 'mdi mdi-play')
            },
            error: function(err) {
                alert(`Ops..! ${err.statusText}. Periksa koneksi internet anda !`);
                $('span.span-step-1').text('RUN').prev().prop('class', 'mdi mdi-play')
            }
        })

    })
</script>

<!-- data table  -->
<script>
    function runDatatable(table, data) {
        $(table).DataTable().destroy();
        var table = $(table).DataTable({
            data: data,
            pageLength: 5,
            dom: 'Bfrtlip',
            buttons: [
                'csv', 'excel', 'pdf'
            ]
        });
    }
</script>

<!-- hitung summary  -->
<script>
    $(function() {
        $('button#submit-step-2').click(function() {

            $('div#div-step-3').show()

            let total = Object.values(summary).reduce((a, b) => a + b, 0);

            let ppos = (summary.positif / total) * 100
            let pneg = (summary.negatif / total) * 100
            let pnet = (summary.netral / total) * 100

            persen = {
                'positif': ppos,
                'negatif': pneg,
                'netral': pnet
            }

            let colors = ['#4bc46a', '#fa5a5a', "#188ae2"];
            let data = [{
                label: 'Positif',
                data: persen.positif
            }, {
                label: 'Negatif',
                data: persen.negatif
            }, {
                label: 'Netral',
                data: persen.netral
            }]
            console.log(data);
            $.plot('#pie-chart #pie-chart-container', data, {
                series: {
                    pie: {
                        show: true
                    }
                },
                legend: {
                    show: false
                },
                grid: {
                    hoverable: true,
                    clickable: true
                },
                colors: colors,
                tooltipOpts: {
                    content: "%s, %p.0%"
                }
            });

            $("html, body").delay(500).animate({
                scrollTop: $('#div-step-3').offset().top
            }, 500);

        })
    });
</script>

<!-- save to db  -->
<script>

</script>

<!-- new analysist  -->
<script>
    $('button#new-step-3').click(function() {
        summary = null
        persen = null
        datadb = null

        $('div#div-step-2').hide()
        $('div#div-step-3').hide()
    })
</script>