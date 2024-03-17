// Logic IO
const IO = () => {
    //IO Koefisien Tertutup
    let chart_bar_io_koefisien_tertutup = $("#bar-io-tertutup")
        .get(0)
        .getContext("2d");
    let list_sektor_koefisien_tertutup = {
        pertanian_tanaman_pangan: 0.40384904729412224,
        pertanian_tanaman_hortikultura_semusim_hortikultura_tahunan_dan: 0.4088482890475885,
        perkebunan_semusim_dan_tahunan: 0,
        peternakan: 0.4525030045159831,
        jasa_pertanian_dan_perburuan: 0.4908455781313119,
        kehutanan_dan_penebangan_kayu: 0,
        perikanan: 0.33083862958000554,
        pertambangan_minyak_gas_dan_panas_bumi: 0.1794308102878157,
        pertambangan_batubara_dan_lignit: 0,
        pertambangan_bijih_logam: 0,
        pertambangan_dan_penggalian_lainnya: 0,
        industri_batubara_dan_pengilangan_migas: 0.4271499510023418,
        industri_makanan_dan_minuman: 1.0647531881432923,
        industri_pengolahan_tembakau: 0,
        industri_tekstil_dan_pakaian_jadi: 0.43460208859182914,
        industri_kulit_barang_dari_kulit_dan_alas_kaki: 0.12697951701938417,
        industri_kayu_barang_dari_kayu_dan_gabus_dan_barang_anyaman_dar: 0.22687064810580382,
        industri_kertas_dan_barang_dari_kertas_percetakan_dan_reproduks: 0.32326480038966277,
        industri_kimia_farmasi_dan_obat_tradisional: 0.2476316801477924,
        industri_karet_barang_dari_karet_dan_plastik: 0.2306245376735279,
        industri_barang_galian_bukan_logam: 0.3882005836028792,
        industri_logam_dasar: 0.23044229206669212,
        industri_barang_dari_logam_komputer_barang_elektronik_optik_dan: 0.3708669951683822,
        industri_mesin_dan_perlengkapan_ytdl: 0.01621686274046563,
        industri_alat_angkutan: 0.8931682537442942,
        industri_furnitur: 0.33503362102495166,
        industri_pengolahan_lainnya_jasa_reparasi_dan_pemasangan_mesin_: 0.2566476292243287,
        ketenagalistrikan: 1.03583688431171,
        pengadaan_gas_dan_produksi_es: 0.07420019948499831,
        pengadaan_air_pengelolaan_sampah_limbah_dan_daur_ulang: 0.19700829090397137,
        konstruksi: 3.6050871607943242,
        perdagangan_mobil_sepeda_motor_dan_reparasinya: 0.5142244182475539,
        perdagangan_besar_dan_eceran_bukan_mobil_dan_sepeda_motor: 0.9594586756608001,
        angkutan_rel: 0.4324405221975879,
        angkutan_darat: 0.5792854197238546,
        angkutan_laut: 0.18756604285205553,
        angkutan_sungai_danau_dan_penyeberangan: 0.12702730059831416,
        angkutan_udara: 0.3327651152216994,
        pergudangan_dan_jasa_penunjang_angkutan_pos_dan_kurir: 0.4724895850980037,
        penyediaan_akomodasi: 0.22550090317187246,
        penyediaan_makan_minum: 0.9092248997390667,
        jasa_informasi_dan_komunikasi: 0.5257775807143881,
        jasa_perantara_keuangan_selain_bank_sentral: 0.857754185891423,
        asuransi_dan_dana_pensiun: 0.47890166743780704,
        jasa_keuangan_lainnya: 0.46405657977158976,
        jasa_penunjang_keuangan: 0.4421796970029349,
        real_estate: 0.4914340258602814,
        jasa_perusahaan: 1.035034825365889,
        administrasi_pemerintahan_pertahanan_dan_jaminan_sosial_wajib: 1.597508866632919,
        jasa_pendidikan: 0.7010364755688072,
        jasa_kesehatan_dan_kegiatan_sosial: 0.5791357328020081,
        jasa_lainnya: 0.7944014815416385,
    };

    let html_koefisien_tertutup = "";
    html_koefisien_tertutup += `<option value="">Pilih Sektor</option>`;

    for (let i in list_sektor_koefisien_tertutup) {
        let sektor = i;
        let nilai = list_sektor_koefisien_tertutup[i];
        let id = titleCase(sektor.replaceAll("_", " "));
        html_koefisien_tertutup += `<option value="${nilai}">${id}</option>`;
    }

    $("#sektorInputTertutup").html(html_koefisien_tertutup);

    const get_chart_koefisien_tertutup = (
        nilai_investasi = parseInt(
            $("#nilaiInvestasiTertutup").val().replaceAll(".", "")
        ),
        sektor = $("#sektorInputTertutup option:selected").text()
    ) => {
        $.ajax({
            url: `${url_api}/iotop`,
            type: "GET",
            data: {
                nilai_investasi: nilai_investasi,
                sektor: sektor.toLowerCase().replaceAll(" ", "_"),
            },
            headers: {
                Authorization: `Bearer ${token}`,
            },
            dataType: "json",
            success: (res) => {
                const data = res.features;
                let top_list_sektor = [];
                let top_koefisien_list_sektor = [];

                data.forEach(({ properties }) => {
                    const { sektor, result } = properties;
                    top_koefisien_list_sektor.push(result);
                    top_list_sektor.push(
                        titleCase(sektor.replaceAll("_", " "))
                    );
                });

                if (bar_io_tertutup != undefined) {
                    bar_io_tertutup.destroy();
                }

                bar_io_tertutup = new Chart(chart_bar_io_koefisien_tertutup, {
                    type: "horizontalBar",
                    data: {
                        labels: top_list_sektor,
                        datasets: [
                            {
                                label: "Dampak",
                                data: top_koefisien_list_sektor,
                                backgroundColor: [
                                    "rgba(255, 99, 132, 0.2)",
                                    "rgba(54, 162, 235, 0.2)",
                                    "rgba(255, 206, 86, 0.2)",
                                    "rgba(75, 192, 192, 0.2)",
                                    "rgba(153, 102, 255, 0.2)",
                                    "rgba(255, 159, 64, 0.2)",
                                ],
                                borderColor: [
                                    "rgba(255, 99, 132, 1)",
                                    "rgba(54, 162, 235, 1)",
                                    "rgba(255, 206, 86, 1)",
                                    "rgba(75, 192, 192, 1)",
                                    "rgba(153, 102, 255, 1)",
                                    "rgba(255, 159, 64, 1)",
                                ],
                            },
                        ],
                    },
                    options: {
                        title: {
                            display: true,
                            text: "5 Sektor dengan Dampak Terbesar",
                        },
                        indexAxis: "y",
                        legend: {
                            display: false,
                        },
                        plugins: {
                            legend: {
                                position: "right",
                            },
                            title: {
                                display: true,
                                text: "5 Sektor dengan Dampak Terbesar",
                            },
                        },
                        scales: {
                            xAxes: [
                                {
                                    gridLines: {
                                        color: "rgba(0, 0, 0, 0)",
                                    },
                                },
                            ],
                            yAxes: [
                                {
                                    gridLines: {
                                        color: "rgba(0, 0, 0, 0)",
                                    },
                                    ticks: { mirror: true },
                                },
                            ],
                        },
                    },
                });
            },
        });
    };

    $("#nilaiInvestasiTertutup").on("keyup", (e) => {
        let nilai = parseInt(e.target.value.replaceAll(".", ""));
        let sektor = Math.round($("#sektorInputTertutup").val() * 1000) / 1000;
        let total = nilai * sektor;

        $(".inf-dampak-io-tertutup").html(separatorNum(Math.round(total)));

        get_chart_koefisien_tertutup();
    });

    $("#sektorInputTertutup").on("change", () => {
        let nilai = parseInt(
            $("#nilaiInvestasiTertutup").val().replaceAll(".", "")
        );
        let sektor = Math.round($("#sektorInputTertutup").val() * 1000) / 1000;
        let total = nilai * sektor;

        $(".inf-dampak-io-tertutup").html(separatorNum(Math.round(total)));

        get_chart_koefisien_tertutup();
    });

    // Leontiff Kebalikan Terbuka
    let chart_bar_io_koefisien_leontiff_terbuka = $("#bar-io-leontiff")
        .get(0)
        .getContext("2d");

    let list_sektor_leontiff_terbuka = {
        pertanian_tanaman_pangan: 1.004601389451335,
        pertanian_tanaman_hortikultura_semusim_hortikultura_tahunan_dan: 1.0067217711030358,
        perkebunan_semusim_dan_tahunan: 1,
        peternakan: 1.0011160753395827,
        jasa_pertanian_dan_perburuan: 1.0001444849102863,
        kehutanan_dan_penebangan_kayu: 1,
        perikanan: 1.0109211310365671,
        pertambangan_minyak_gas_dan_panas_bumi: 1.123262456449879,
        pertambangan_batubara_dan_lignit: 1,
        pertambangan_bijih_logam: 1,
        pertambangan_dan_penggalian_lainnya: 1,
        industri_batubara_dan_pengilangan_migas: 1.410471595371458,
        industri_makanan_dan_minuman: 2.103276420553818,
        industri_pengolahan_tembakau: 1,
        industri_tekstil_dan_pakaian_jadi: 1.4256591279166242,
        industri_kulit_barang_dari_kulit_dan_alas_kaki: 1.0367052004853041,
        industri_kayu_barang_dari_kayu_dan_gabus_dan_barang_anyaman_dar: 1.04147509180359,
        industri_kertas_dan_barang_dari_kertas_percetakan_dan_reproduks: 1.2009519882655653,
        industri_kimia_farmasi_dan_obat_tradisional: 1.2476071419405166,
        industri_karet_barang_dari_karet_dan_plastik: 1.1752339503256901,
        industri_barang_galian_bukan_logam: 1.1501517192980388,
        industri_logam_dasar: 1.1155797963242904,
        industri_barang_dari_logam_komputer_barang_elektronik_optik_dan: 1.3624986677409352,
        industri_mesin_dan_perlengkapan_ytdl: 1.0087622628035409,
        industri_alat_angkutan: 2.008445933991775,
        industri_furnitur: 1.070044734683425,
        industri_pengolahan_lainnya_jasa_reparasi_dan_pemasangan_mesin_: 1.128068221113132,
        ketenagalistrikan: 3.1449248640623004,
        pengadaan_gas_dan_produksi_es: 1.039046134088361,
        pengadaan_air_pengelolaan_sampah_limbah_dan_daur_ulang: 1.0459076916365553,
        konstruksi: 5.574356792061894,
        perdagangan_mobil_sepeda_motor_dan_reparasinya: 1.3079701072595427,
        perdagangan_besar_dan_eceran_bukan_mobil_dan_sepeda_motor: 1.9230330928018722,
        angkutan_rel: 1.0269915215258236,
        angkutan_darat: 1.6513389018578555,
        angkutan_laut: 1.15919857862909,
        angkutan_sungai_danau_dan_penyeberangan: 1.000859824928944,
        angkutan_udara: 1.1758146738907056,
        pergudangan_dan_jasa_penunjang_angkutan_pos_dan_kurir: 1.3830398184130195,
        penyediaan_akomodasi: 1.1095342420861771,
        penyediaan_makan_minum: 1.8795026745181747,
        jasa_informasi_dan_komunikasi: 1.59319026470879,
        jasa_perantara_keuangan_selain_bank_sentral: 1.6555911738446945,
        asuransi_dan_dana_pensiun: 1.2336874854358575,
        jasa_keuangan_lainnya: 1.1383095975564532,
        jasa_penunjang_keuangan: 1.1796132848379275,
        real_estate: 1.6704834940780686,
        jasa_perusahaan: 2.172073285118277,
        administrasi_pemerintahan_pertahanan_dan_jaminan_sosial_wajib: 2.7151355901420198,
        jasa_pendidikan: 1.497492333528255,
        jasa_kesehatan_dan_kegiatan_sosial: 1.5680963402215058,
        jasa_lainnya: 1.6164240476574858,
    };

    let html_koefisien_leontiff = "";
    html_koefisien_leontiff += `<option value="">Pilih Sektor</option>`;

    for (let i in list_sektor_leontiff_terbuka) {
        let sektor = i;
        let nilai = list_sektor_leontiff_terbuka[i];
        let id = titleCase(sektor.replaceAll("_", " "));
        html_koefisien_leontiff += `<option value="${nilai}">${id}</option>`;
    }

    $("#sektorInputLeontiff").html(html_koefisien_leontiff);

    const get_chart_leontiff_kebalikan_terbuka = (
        nilai_investasi = parseInt(
            $("#nilaiInvestasiLeontiff").val().replaceAll(".", "")
        ),
        sektor = $("#sektorInputLeontiff option:selected").text()
    ) => {
        $.ajax({
            url: `${url_api}/iotop`,
            type: "POST",
            data: {
                nilai_investasi: nilai_investasi,
                sektor: sektor.toLowerCase().replaceAll(" ", "_"),
            },
            headers: {
                Authorization: `Bearer ${token}`,
            },
            dataType: "json",
            success: (res) => {
                const data = res.features;
                let top_list_sektor = [];
                let top_koefisien_list_sektor = [];

                data.forEach(({ properties }) => {
                    const { sektor, result } = properties;
                    top_koefisien_list_sektor.push(result);
                    top_list_sektor.push(
                        titleCase(sektor.replaceAll("_", " "))
                    );
                });

                if (bar_io_leontiff_terbuka != undefined) {
                    bar_io_leontiff_terbuka.destroy();
                }

                bar_io_leontiff_terbuka = new Chart(
                    chart_bar_io_koefisien_leontiff_terbuka,
                    {
                        type: "horizontalBar",
                        data: {
                            labels: top_list_sektor,
                            datasets: [
                                {
                                    label: "Dampak",
                                    data: top_koefisien_list_sektor,
                                    backgroundColor: [
                                        "rgba(255, 99, 132, 0.2)",
                                        "rgba(54, 162, 235, 0.2)",
                                        "rgba(255, 206, 86, 0.2)",
                                        "rgba(75, 192, 192, 0.2)",
                                        "rgba(153, 102, 255, 0.2)",
                                        "rgba(255, 159, 64, 0.2)",
                                    ],
                                    borderColor: [
                                        "rgba(255, 99, 132, 1)",
                                        "rgba(54, 162, 235, 1)",
                                        "rgba(255, 206, 86, 1)",
                                        "rgba(75, 192, 192, 1)",
                                        "rgba(153, 102, 255, 1)",
                                        "rgba(255, 159, 64, 1)",
                                    ],
                                },
                            ],
                        },
                        options: {
                            title: {
                                display: true,
                                text: "5 Sektor dengan Dampak Terbesar",
                            },
                            indexAxis: "y",
                            legend: {
                                display: false,
                            },
                            plugins: {
                                legend: {
                                    position: "right",
                                },
                                title: {
                                    display: true,
                                    text: "5 Sektor dengan Dampak Terbesar",
                                },
                            },
                            scales: {
                                xAxes: [
                                    {
                                        gridLines: {
                                            color: "rgba(0, 0, 0, 0)",
                                        },
                                    },
                                ],
                                yAxes: [
                                    {
                                        gridLines: {
                                            color: "rgba(0, 0, 0, 0)",
                                        },
                                        ticks: { mirror: true },
                                    },
                                ],
                            },
                        },
                    }
                );
            },
        });
    };

    $("#nilaiInvestasiLeontiff").on("keyup", (e) => {
        let nilai = parseInt(e.target.value.replaceAll(".", ""));
        let sektor = Math.round($("#sektorInputLeontiff").val() * 1000) / 1000;
        let total = nilai * sektor;

        $(".inf-dampak-io-leontiff").html(separatorNum(Math.round(total)));

        get_chart_leontiff_kebalikan_terbuka();
    });

    $("#sektorInputLeontiff").on("change", () => {
        let nilai = parseInt(
            $("#nilaiInvestasiLeontiff").val().replaceAll(".", "")
        );
        let sektor = Math.round($("#sektorInputLeontiff").val() * 1000) / 1000;
        let total = nilai * sektor;

        $(".inf-dampak-io-leontiff").html(separatorNum(Math.round(total)));

        get_chart_leontiff_kebalikan_terbuka();
    });

    //IO Dampak Pendapatan
    let chart_bar_io_dampak_pendapatan = $("#bar-io-dampak-pendapatan")
        .get(0)
        .getContext("2d");

    let list_sektor_dampak_pendapatan = {
        pertanian_tanaman_pangan: 1.0055169575785479,
        pertanian_tanaman_hortikultura_semusim_hortikultura_tahunan_dan: 1.007705527937273,
        peternakan: 1.0009599147264718,
        jasa_pertanian_dan_perburuan: 1.0000473948095114,
        perikanan: 1.007704310279649,
        pertambangan_minyak_gas_dan_panas_bumi: 1.1358163222810276,
        industri_batubara_dan_pengilangan_migas: 1.4808262663985954,
        industri_makanan_dan_minuman: 6.860313630620517,
        industri_tekstil_dan_pakaian_jadi: 1.5170865130028568,
        industri_kulit_barang_dari_kulit_dan_alas_kaki: 1.0449096163582794,
        industri_kayu_barang_dari_kayu_dan_gabus_dan_barang_anyaman_dar: 1.0428309137615066,
        industri_kertas_dan_barang_dari_kertas_percetakan_dan_reproduks: 1.2225479228835143,
        industri_kimia_farmasi_dan_obat_tradisional: 1.6105087121413562,
        industri_karet_barang_dari_karet_dan_plastik: 1.2478301412942012,
        industri_barang_galian_bukan_logam: 1.07922141858336,
        industri_logam_dasar: 1.0874521617490323,
        industri_barang_dari_logam_komputer_barang_elektronik_optik_dan: 1.6478850514770509,
        industri_mesin_dan_perlengkapan_ytdl: 1.158467641356728,
        industri_alat_angkutan: 1.9003364761130865,
        industri_furnitur: 1.0490940542317544,
        industri_pengolahan_lainnya_jasa_reparasi_dan_pemasangan_mesin_: 1.126677557298696,
        ketenagalistrikan: 5.534094041236607,
        pengadaan_gas_dan_produksi_es: 1.092641971755856,
        pengadaan_air_pengelolaan_sampah_limbah_dan_daur_ulang: 1.0548856335244148,
        konstruksi: 7.821055387427211,
        perdagangan_mobil_sepeda_motor_dan_reparasinya: 1.2195228873804913,
        perdagangan_besar_dan_eceran_bukan_mobil_dan_sepeda_motor: 1.6131546815973778,
        angkutan_rel: 1.0116990986950354,
        angkutan_darat: 1.847065376891612,
        angkutan_laut: 1.358605685529158,
        angkutan_sungai_danau_dan_penyeberangan: 1.001184623558062,
        angkutan_udara: 1.1260961891198364,
        pergudangan_dan_jasa_penunjang_angkutan_pos_dan_kurir: 1.3257176853110382,
        penyediaan_akomodasi: 1.1425705624749785,
        penyediaan_makan_minum: 1.8296825770317693,
        jasa_informasi_dan_komunikasi: 1.8061847994932387,
        jasa_perantara_keuangan_selain_bank_sentral: 1.3764640420725307,
        asuransi_dan_dana_pensiun: 1.1954411497450632,
        jasa_keuangan_lainnya: 1.109519174988858,
        jasa_penunjang_keuangan: 1.1628716061681246,
        real_estate: 2.6413179721079927,
        jasa_perusahaan: 2.0090135247058782,
        administrasi_pemerintahan_pertahanan_dan_jaminan_sosial_wajib: 2.504031800966973,
        jasa_pendidikan: 1.2412816991566957,
        jasa_kesehatan_dan_kegiatan_sosial: 1.4626955508977055,
        jasa_lainnya: 1.298619921576587,
    };

    let html_dampak_pendapatan = "";
    html_dampak_pendapatan += `<option value="">Pilih Sektor</option>`;

    for (let i in list_sektor_dampak_pendapatan) {
        let sektor = i;
        let nilai = list_sektor_dampak_pendapatan[i];
        let id = titleCase(sektor.replaceAll("_", " "));
        html_dampak_pendapatan += `<option value="${nilai}">${id}</option>`;
    }

    $("#sektorInputDampakPendapatan").html(html_dampak_pendapatan);

    const get_chart_dampak_pendapatan = (
        nilai_investasi = parseInt(
            $("#nilaiInvestasiDampakPendapatan").val().replaceAll(".", "")
        ),
        sektor = $("#sektorInputDampakPendapatan option:selected").text()
    ) => {
        $.ajax({
            url: `${url_api}/iotop`,
            type: "PUT",
            data: {
                nilai_investasi: nilai_investasi,
                sektor: sektor.toLowerCase().replaceAll(" ", "_"),
            },
            headers: {
                Authorization: `Bearer ${token}`,
            },
            dataType: "json",
            success: (res) => {
                const data = res.features;
                let top_list_sektor = [];
                let top_koefisien_list_sektor = [];

                data.forEach(({ properties }) => {
                    const { sektor, result } = properties;
                    top_koefisien_list_sektor.push(result);
                    top_list_sektor.push(
                        titleCase(sektor.replaceAll("_", " "))
                    );
                });

                if (bar_io_dampak_pendapatan != undefined) {
                    bar_io_dampak_pendapatan.destroy();
                }

                bar_io_dampak_pendapatan = new Chart(
                    chart_bar_io_dampak_pendapatan,
                    {
                        type: "horizontalBar",
                        data: {
                            labels: top_list_sektor,
                            datasets: [
                                {
                                    label: "Dampak",
                                    data: top_koefisien_list_sektor,
                                    backgroundColor: [
                                        "rgba(255, 99, 132, 0.2)",
                                        "rgba(54, 162, 235, 0.2)",
                                        "rgba(255, 206, 86, 0.2)",
                                        "rgba(75, 192, 192, 0.2)",
                                        "rgba(153, 102, 255, 0.2)",
                                        "rgba(255, 159, 64, 0.2)",
                                    ],
                                    borderColor: [
                                        "rgba(255, 99, 132, 1)",
                                        "rgba(54, 162, 235, 1)",
                                        "rgba(255, 206, 86, 1)",
                                        "rgba(75, 192, 192, 1)",
                                        "rgba(153, 102, 255, 1)",
                                        "rgba(255, 159, 64, 1)",
                                    ],
                                },
                            ],
                        },
                        options: {
                            title: {
                                display: true,
                                text: "5 Sektor dengan Dampak Terbesar",
                            },
                            indexAxis: "y",
                            legend: {
                                display: false,
                            },
                            plugins: {
                                legend: {
                                    position: "right",
                                },
                                title: {
                                    display: true,
                                    text: "5 Sektor dengan Dampak Terbesar",
                                },
                            },
                            scales: {
                                xAxes: [
                                    {
                                        gridLines: {
                                            color: "rgba(0, 0, 0, 0)",
                                        },
                                    },
                                ],
                                yAxes: [
                                    {
                                        gridLines: {
                                            color: "rgba(0, 0, 0, 0)",
                                        },
                                        ticks: { mirror: true },
                                    },
                                ],
                            },
                        },
                    }
                );
            },
        });
    };

    $("#nilaiInvestasiDampakPendapatan").on("keyup", (e) => {
        let nilai = parseInt(e.target.value.replaceAll(".", ""));
        let sektor =
            Math.round($("#sektorInputDampakPendapatan").val() * 1000) / 1000;
        let total = nilai * sektor;

        $(".inf-dampak-io-dampak-pendapatan").html(
            separatorNum(Math.round(total))
        );

        get_chart_dampak_pendapatan();
    });

    $("#sektorInputDampakPendapatan").on("change", () => {
        let nilai = parseInt(
            $("#nilaiInvestasiDampakPendapatan").val().replaceAll(".", "")
        );
        let sektor =
            Math.round($("#sektorInputDampakPendapatan").val() * 1000) / 1000;
        let total = nilai * sektor;

        $(".inf-dampak-io-dampak-pendapatan").html(
            separatorNum(Math.round(total))
        );

        get_chart_dampak_pendapatan();
    });

    //IO Dampak Pendapatan Bruto
    let chart_bar_io_dampak_pendapatan_bruto = $(
        "#bar-io-dampak-pendapatan-bruto"
    )
        .get(0)
        .getContext("2d");

    let list_sektor_dampak_pendapatan_bruto = {
        pertanian_tanaman_pangan: 1.0047139807470358,
        pertanian_tanaman_hortikultura_semusim_hortikultura_tahunan_dan: 1.0061832308908374,
        perkebunan_semusim_dan_tahunan: 0,
        peternakan: 1.0010417823904598,
        jasa_pertanian_dan_perburuan: 1.000088840359169,
        kehutanan_dan_penebangan_kayu: 0,
        perikanan: 1.0084554572212328,
        pertambangan_minyak_gas_dan_panas_bumi: 1.1199434970247135,
        pertambangan_batubara_dan_lignit: 0,
        pertambangan_bijih_logam: 0,
        pertambangan_dan_penggalian_lainnya: 0,
        industri_batubara_dan_pengilangan_migas: 1.8575779917349018,
        industri_makanan_dan_minuman: 3.7158131850009126,
        industri_pengolahan_tembakau: 0,
        industri_tekstil_dan_pakaian_jadi: 1.5709588317823662,
        industri_kulit_barang_dari_kulit_dan_alas_kaki: 1.037962986270818,
        industri_kayu_barang_dari_kayu_dan_gabus_dan_barang_anyaman_dar: 1.0427320044106918,
        industri_kertas_dan_barang_dari_kertas_percetakan_dan_reproduks: 1.2518600326934572,
        industri_kimia_farmasi_dan_obat_tradisional: 1.3637259660853738,
        industri_karet_barang_dari_karet_dan_plastik: 1.2216003064376388,
        industri_barang_galian_bukan_logam: 1.1959994273765875,
        industri_logam_dasar: 1.1468482812210192,
        industri_barang_dari_logam_komputer_barang_elektronik_optik_dan: 1.5272159738825366,
        industri_mesin_dan_perlengkapan_ytdl: 1.0090750314895627,
        industri_alat_angkutan: 2.0383959993539777,
        industri_furnitur: 1.055323333816263,
        industri_pengolahan_lainnya_jasa_reparasi_dan_pemasangan_mesin_: 1.1179647104959383,
        ketenagalistrikan: 11.786966996247916,
        pengadaan_gas_dan_produksi_es: 1.0415026673846142,
        pengadaan_air_pengelolaan_sampah_limbah_dan_daur_ulang: 1.046490704358207,
        konstruksi: 7.62053728993327,
        perdagangan_mobil_sepeda_motor_dan_reparasinya: 1.2468355980962718,
        perdagangan_besar_dan_eceran_bukan_mobil_dan_sepeda_motor: 1.6539785273945407,
        angkutan_rel: 1.0290027582853578,
        angkutan_darat: 1.689403613544005,
        angkutan_laut: 1.280017776781775,
        angkutan_sungai_danau_dan_penyeberangan: 1.0009970271753412,
        angkutan_udara: 1.215132705192893,
        pergudangan_dan_jasa_penunjang_angkutan_pos_dan_kurir: 1.3314269060971757,
        penyediaan_akomodasi: 1.0966745445040709,
        penyediaan_makan_minum: 2.104656163509589,
        jasa_informasi_dan_komunikasi: 1.5235614147000687,
        jasa_perantara_keuangan_selain_bank_sentral: 1.5474520231086037,
        asuransi_dan_dana_pensiun: 1.191477973418007,
        jasa_keuangan_lainnya: 1.1227732090612776,
        jasa_penunjang_keuangan: 1.1557226837742136,
        real_estate: 1.5212483856904233,
        jasa_perusahaan: 2.1251487267374145,
        administrasi_pemerintahan_pertahanan_dan_jaminan_sosial_wajib: 3.22665447172148,
        jasa_pendidikan: 1.4226527822967996,
        jasa_kesehatan_dan_kegiatan_sosial: 1.790650400176819,
        jasa_lainnya: 1.5153676744013382,
    };

    let html_dampak_pendapatan_bruto = "";
    html_dampak_pendapatan_bruto += `<option value="">Pilih Sektor</option>`;

    for (let i in list_sektor_dampak_pendapatan_bruto) {
        let sektor = i;
        let nilai = list_sektor_dampak_pendapatan_bruto[i];
        let id = titleCase(sektor.replaceAll("_", " "));
        html_dampak_pendapatan_bruto += `<option value="${nilai}">${id}</option>`;
    }

    $("#sektorInputDampakPendapatanBruto").html(html_dampak_pendapatan_bruto);

    const get_chart_dampak_pendapatan_bruto = (
        nilai_investasi = parseInt(
            $("#nilaiInvestasiDampakPendapatanBruto").val().replaceAll(".", "")
        ),
        sektor = $("#sektorInputDampakPendapatanBruto option:selected").text()
    ) => {
        $.ajax({
            url: `${url_api}/iotop`,
            type: "PATCH",
            data: {
                nilai_investasi: nilai_investasi,
                sektor: sektor.toLowerCase().replaceAll(" ", "_"),
            },
            headers: {
                Authorization: `Bearer ${token}`,
            },
            dataType: "json",
            success: (res) => {
                const data = res.features;
                let top_list_sektor = [];
                let top_koefisien_list_sektor = [];

                data.forEach(({ properties }) => {
                    const { sektor, result } = properties;
                    top_koefisien_list_sektor.push(result);
                    top_list_sektor.push(
                        titleCase(sektor.replaceAll("_", " "))
                    );
                });

                if (bar_io_dampak_pendapatan_bruto != undefined) {
                    bar_io_dampak_pendapatan_bruto.destroy();
                }

                bar_io_dampak_pendapatan_bruto = new Chart(
                    chart_bar_io_dampak_pendapatan_bruto,
                    {
                        type: "horizontalBar",
                        data: {
                            labels: top_list_sektor,
                            datasets: [
                                {
                                    label: "Dampak",
                                    data: top_koefisien_list_sektor,
                                    backgroundColor: [
                                        "rgba(255, 99, 132, 0.2)",
                                        "rgba(54, 162, 235, 0.2)",
                                        "rgba(255, 206, 86, 0.2)",
                                        "rgba(75, 192, 192, 0.2)",
                                        "rgba(153, 102, 255, 0.2)",
                                        "rgba(255, 159, 64, 0.2)",
                                    ],
                                    borderColor: [
                                        "rgba(255, 99, 132, 1)",
                                        "rgba(54, 162, 235, 1)",
                                        "rgba(255, 206, 86, 1)",
                                        "rgba(75, 192, 192, 1)",
                                        "rgba(153, 102, 255, 1)",
                                        "rgba(255, 159, 64, 1)",
                                    ],
                                },
                            ],
                        },
                        options: {
                            title: {
                                display: true,
                                text: "5 Sektor dengan Dampak Terbesar",
                            },
                            indexAxis: "y",
                            legend: {
                                display: false,
                            },
                            plugins: {
                                legend: {
                                    position: "right",
                                },
                                title: {
                                    display: true,
                                    text: "5 Sektor dengan Dampak Terbesar",
                                },
                            },
                            scales: {
                                xAxes: [
                                    {
                                        gridLines: {
                                            color: "rgba(0, 0, 0, 0)",
                                        },
                                    },
                                ],
                                yAxes: [
                                    {
                                        gridLines: {
                                            color: "rgba(0, 0, 0, 0)",
                                        },
                                        ticks: { mirror: true },
                                    },
                                ],
                            },
                        },
                    }
                );
            },
        });
    };

    $("#nilaiInvestasiDampakPendapatanBruto").on("keyup", (e) => {
        let nilai = parseInt(e.target.value.replaceAll(".", ""));
        let sektor =
            Math.round($("#sektorInputDampakPendapatanBruto").val() * 1000) /
            1000;
        let total = nilai * sektor;

        $(".inf-dampak-io-dampak-pendapatan-bruto").html(
            separatorNum(Math.round(total))
        );

        get_chart_dampak_pendapatan_bruto();
    });

    $("#sektorInputDampakPendapatanBruto").on("change", () => {
        let nilai = parseInt(
            $("#nilaiInvestasiDampakPendapatanBruto").val().replaceAll(".", "")
        );
        let sektor =
            Math.round($("#sektorInputDampakPendapatanBruto").val() * 1000) /
            1000;
        let total = nilai * sektor;

        $(".inf-dampak-io-dampak-pendapatan-bruto").html(
            separatorNum(Math.round(total))
        );

        get_chart_dampak_pendapatan_bruto();
    });

    // IO Pengganda Dampak Kerja
    let chart_bar_io_pengganda_dampak_kerja = $(
        "#bar-io-pengganda-dampak-kerja"
    )
        .get(0)
        .getContext("2d");

    let list_sektor_pengganda_dampak_kerja = {
        pertanian_tanaman_pangan: 1.0055169575785479,
        pertanian_tanaman_hortikultura_semusim_hortikultura_tahunan_dan: 1.007705527937273,
        peternakan: 1.0009599147264718,
        jasa_pertanian_dan_perburuan: 1.0000473948095114,
        perikanan: 1.007704310279649,
        pertambangan_minyak_gas_dan_panas_bumi: 1.1358163222810276,
        industri_batubara_dan_pengilangan_migas: 1.4808262663985954,
        industri_makanan_dan_minuman: 6.860313630620517,
        industri_tekstil_dan_pakaian_jadi: 1.5170865130028568,
        industri_kulit_barang_dari_kulit_dan_alas_kaki: 1.0449096163582794,
        industri_kayu_barang_dari_kayu_dan_gabus_dan_barang_anyaman_dar: 1.0428309137615066,
        industri_kertas_dan_barang_dari_kertas_percetakan_dan_reproduks: 1.2225479228835143,
        industri_kimia_farmasi_dan_obat_tradisional: 1.6105087121413562,
        industri_karet_barang_dari_karet_dan_plastik: 1.2478301412942012,
        industri_barang_galian_bukan_logam: 1.07922141858336,
        industri_logam_dasar: 1.0874521617490323,
        industri_barang_dari_logam_komputer_barang_elektronik_optik_dan: 1.6478850514770509,
        industri_mesin_dan_perlengkapan_ytdl: 1.158467641356728,
        industri_alat_angkutan: 1.9003364761130865,
        industri_furnitur: 1.0490940542317544,
        industri_pengolahan_lainnya_jasa_reparasi_dan_pemasangan_mesin_: 1.126677557298696,
        ketenagalistrikan: 5.534094041236607,
        pengadaan_gas_dan_produksi_es: 1.092641971755856,
        pengadaan_air_pengelolaan_sampah_limbah_dan_daur_ulang: 1.0548856335244148,
        konstruksi: 7.821055387427211,
        perdagangan_mobil_sepeda_motor_dan_reparasinya: 1.2195228873804913,
        perdagangan_besar_dan_eceran_bukan_mobil_dan_sepeda_motor: 1.6131546815973778,
        angkutan_rel: 1.0116990986950354,
        angkutan_darat: 1.847065376891612,
        angkutan_laut: 1.358605685529158,
        angkutan_sungai_danau_dan_penyeberangan: 1.001184623558062,
        angkutan_udara: 1.1260961891198364,
        pergudangan_dan_jasa_penunjang_angkutan_pos_dan_kurir: 1.3257176853110382,
        penyediaan_akomodasi: 1.1425705624749785,
        penyediaan_makan_minum: 1.8296825770317693,
        jasa_informasi_dan_komunikasi: 1.8061847994932387,
        jasa_perantara_keuangan_selain_bank_sentral: 1.3764640420725307,
        asuransi_dan_dana_pensiun: 1.1954411497450632,
        jasa_keuangan_lainnya: 1.109519174988858,
        jasa_penunjang_keuangan: 1.1628716061681246,
        real_estate: 2.6413179721079927,
        jasa_perusahaan: 2.0090135247058782,
        administrasi_pemerintahan_pertahanan_dan_jaminan_sosial_wajib: 2.504031800966973,
        jasa_pendidikan: 1.2412816991566957,
        jasa_kesehatan_dan_kegiatan_sosial: 1.4626955508977055,
        jasa_lainnya: 1.298619921576587,
    };

    let html_pengganda_dampak_kerja = "";
    html_pengganda_dampak_kerja += `<option value="">Pilih Sektor</option>`;

    for (let i in list_sektor_pengganda_dampak_kerja) {
        let sektor = i;
        let nilai = list_sektor_pengganda_dampak_kerja[i];
        let id = titleCase(sektor.replaceAll("_", " "));
        html_pengganda_dampak_kerja += `<option value="${nilai}">${id}</option>`;
    }

    $("#sektorInputPenggandaDampakKerja").html(html_pengganda_dampak_kerja);

    const get_chart_pengganda_dampak_kerja = (
        nilai_investasi = parseInt(
            $("#nilaiInvestasiPenggandaDampakKerja").val().replaceAll(".", "")
        ),
        sektor = $("#sektorInputPenggandaDampakKerja option:selected").text()
    ) => {
        $.ajax({
            url: `${url_api}/iotop-1`,
            type: "POST",
            data: {
                nilai_investasi: nilai_investasi,
                sektor: sektor.toLowerCase().replaceAll(" ", "_"),
            },
            headers: {
                Authorization: `Bearer ${token}`,
            },
            dataType: "json",
            success: (res) => {
                const data = res.features;
                let top_list_sektor = [];
                let top_koefisien_list_sektor = [];

                data.forEach(({ properties }) => {
                    const { sektor, result } = properties;
                    top_koefisien_list_sektor.push(result);
                    top_list_sektor.push(
                        titleCase(sektor.replaceAll("_", " "))
                    );
                });

                if (bar_io_pengadaan_kerja != undefined) {
                    bar_io_pengadaan_kerja.destroy();
                }

                bar_io_pengadaan_kerja = new Chart(
                    chart_bar_io_pengganda_dampak_kerja,
                    {
                        type: "horizontalBar",
                        data: {
                            labels: top_list_sektor,
                            datasets: [
                                {
                                    label: "Dampak",
                                    data: top_koefisien_list_sektor,
                                    backgroundColor: [
                                        "rgba(255, 99, 132, 0.2)",
                                        "rgba(54, 162, 235, 0.2)",
                                        "rgba(255, 206, 86, 0.2)",
                                        "rgba(75, 192, 192, 0.2)",
                                        "rgba(153, 102, 255, 0.2)",
                                        "rgba(255, 159, 64, 0.2)",
                                    ],
                                    borderColor: [
                                        "rgba(255, 99, 132, 1)",
                                        "rgba(54, 162, 235, 1)",
                                        "rgba(255, 206, 86, 1)",
                                        "rgba(75, 192, 192, 1)",
                                        "rgba(153, 102, 255, 1)",
                                        "rgba(255, 159, 64, 1)",
                                    ],
                                },
                            ],
                        },
                        options: {
                            title: {
                                display: true,
                                text: "5 Sektor dengan Dampak Terbesar",
                            },
                            indexAxis: "y",
                            legend: {
                                display: false,
                            },
                            plugins: {
                                legend: {
                                    position: "right",
                                },
                                title: {
                                    display: true,
                                    text: "5 Sektor dengan Dampak Terbesar",
                                },
                            },
                            scales: {
                                xAxes: [
                                    {
                                        gridLines: {
                                            color: "rgba(0, 0, 0, 0)",
                                        },
                                    },
                                ],
                                yAxes: [
                                    {
                                        gridLines: {
                                            color: "rgba(0, 0, 0, 0)",
                                        },
                                        ticks: { mirror: true },
                                    },
                                ],
                            },
                        },
                    }
                );
            },
        });
    };

    $("#nilaiInvestasiPenggandaDampakKerja").on("keyup", (e) => {
        let nilai = parseInt(e.target.value.replaceAll(".", ""));
        let sektor =
            Math.round($("#sektorInputPenggandaDampakKerja").val() * 1000) /
            1000;
        let total = nilai * sektor;

        $(".inf-dampak-io-pengganda-dampak-kerja").html(
            separatorNum(Math.round(total))
        );

        get_chart_pengganda_dampak_kerja();
    });

    $("#sektorInputPenggandaDampakKerja").on("change", () => {
        let nilai = parseInt(
            $("#nilaiInvestasiPenggandaDampakKerja").val().replaceAll(".", "")
        );
        let sektor =
            Math.round($("#sektorInputPenggandaDampakKerja").val() * 1000) /
            1000;
        let total = nilai * sektor;

        $(".inf-dampak-io-pengganda-dampak-kerja").html(
            separatorNum(Math.round(total))
        );

        get_chart_pengganda_dampak_kerja();
    });

    //IO Keterkaitan Hulu Hilir
    let chart_bar_io_keterkaitan_hulu_hilir = $(
        "#bar-io-keterkaitan-hulu-hilir"
    )
        .get(0)
        .getContext("2d");

    let list_sektor_keterkaitan_hulu_hilir = {
        pertanian_tanaman_pangan: 0.7050470378944834,
        pertanian_tanaman_hortikultura_semusim_hortikultura_tahunan_dan: 0.7065351592712145,
        perkebunan_semusim_dan_tahunan: 0.701817701326839,
        peternakan: 0.7026009827561728,
        jasa_pertanian_dan_perburuan: 0.7019191033944557,
        kehutanan_dan_penebangan_kayu: 0.701817701326839,
        perikanan: 0.7094823444068101,
        pertambangan_minyak_gas_dan_panas_bumi: 0.7883254751723897,
        pertambangan_batubara_dan_lignit: 0.701817701326839,
        pertambangan_bijih_logam: 0.701817701326839,
        pertambangan_dan_penggalian_lainnya: 0.701817701326839,
        industri_batubara_dan_pengilangan_migas: 0.9898939328503953,
        industri_makanan_dan_minuman: 1.4761166227280207,
        industri_pengolahan_tembakau: 0.701817701326839,
        industri_tekstil_dan_pakaian_jadi: 1.000552812030074,
        industri_kulit_barang_dari_kulit_dan_alas_kaki: 0.7275780607581767,
        industri_kayu_barang_dari_kayu_dan_gabus_dan_barang_anyaman_dar: 0.7309256549187542,
        industri_kertas_dan_barang_dari_kertas_percetakan_dan_reproduks: 0.8428493638084342,
        industri_kimia_farmasi_dan_obat_tradisional: 0.8755927765156429,
        industri_karet_barang_dari_karet_dan_plastik: 0.8247999895388328,
        industri_barang_galian_bukan_logam: 0.8071968358148621,
        industri_logam_dasar: 0.7829336483029786,
        industri_barang_dari_logam_komputer_barang_elektronik_optik_dan: 0.9562256830548237,
        industri_mesin_dan_perlengkapan_ytdl: 0.707967212466041,
        industri_alat_angkutan: 1.4095629086333419,
        industri_furnitur: 0.7509763360124052,
        industri_pengolahan_lainnya_jasa_reparasi_dan_pemasangan_mesin_: 0.7916982458814739,
        ketenagalistrikan: 2.2071639389418256,
        pengadaan_gas_dan_produksi_es: 0.7292209693984296,
        pengadaan_air_pengelolaan_sampah_limbah_dan_daur_ulang: 0.7340365319444303,
        konstruksi: 3.912182270180532,
        perdagangan_mobil_sepeda_motor_dan_reparasinya: 0.9179565740811138,
        perdagangan_besar_dan_eceran_bukan_mobil_dan_sepeda_motor: 1.349618664765652,
        angkutan_rel: 0.7207608289194045,
        angkutan_darat: 1.158938872213466,
        angkutan_laut: 0.8135460818348048,
        angkutan_sungai_danau_dan_penyeberangan: 0.7024211416820115,
        angkutan_udara: 0.8252075516163447,
        pergudangan_dan_jasa_penunjang_angkutan_pos_dan_kurir: 0.970641826202114,
        penyediaan_akomodasi: 0.7786907713243353,
        penyediaan_makan_minum: 1.319068246667993,
        jasa_informasi_dan_komunikasi: 1.118129129354221,
        jasa_perantara_keuangan_selain_bank_sentral: 1.1619231919646895,
        asuransi_dan_dana_pensiun: 0.8658237151842779,
        jasa_keuangan_lainnya: 0.7988858251553509,
        jasa_penunjang_keuangan: 0.827873484019553,
        real_estate: 1.1723748859182959,
        jasa_perusahaan: 1.5243994800751404,
        administrasi_pemerintahan_pertahanan_dan_jaminan_sosial_wajib: 1.9055302186641607,
        jasa_pendidikan: 1.0509666272713636,
        jasa_kesehatan_dan_kegiatan_sosial: 1.100517768953285,
        jasa_lainnya: 1.1344350094964,
    };

    let html_keterkaitan_hulu_hilir = "";
    html_keterkaitan_hulu_hilir += `<option value="">Pilih Sektor</option>`;

    for (let i in list_sektor_keterkaitan_hulu_hilir) {
        let sektor = i;
        let nilai = list_sektor_keterkaitan_hulu_hilir[i];
        let id = titleCase(sektor.replaceAll("_", " "));
        html_keterkaitan_hulu_hilir += `<option value="${nilai}">${id}</option>`;
    }

    $("#sektorInputKeterkaitanHuluHilir").html(html_keterkaitan_hulu_hilir);

    const get_chart_keterkaitan_hulu_hilir = (
        nilai_investasi = parseInt(
            $("#nilaiInvestasiKeterkaitanHuluHilir").val().replaceAll(".", "")
        ),
        sektor = $("#sektorInputKeterkaitanHuluHilir option:selected").text()
    ) => {
        $.ajax({
            url: `${url_api}/iotop-1`,
            type: "GET",
            data: {
                nilai_investasi: nilai_investasi,
                sektor: sektor.toLowerCase().replaceAll(" ", "_"),
            },
            headers: {
                Authorization: `Bearer ${token}`,
            },
            dataType: "json",
            success: (res) => {
                const data = res.features;
                let top_list_sektor = [];
                let top_koefisien_list_sektor = [];

                data.forEach(({ properties }) => {
                    const { sektor, result } = properties;
                    top_koefisien_list_sektor.push(result);
                    top_list_sektor.push(
                        titleCase(sektor.replaceAll("_", " "))
                    );
                });

                if (bar_io_keterkaitan_hulu_hilir != undefined) {
                    bar_io_keterkaitan_hulu_hilir.destroy();
                }

                bar_io_keterkaitan_hulu_hilir = new Chart(
                    chart_bar_io_keterkaitan_hulu_hilir,
                    {
                        type: "horizontalBar",
                        data: {
                            labels: top_list_sektor,
                            datasets: [
                                {
                                    label: "Dampak",
                                    data: top_koefisien_list_sektor,
                                    backgroundColor: [
                                        "rgba(255, 99, 132, 0.2)",
                                        "rgba(54, 162, 235, 0.2)",
                                        "rgba(255, 206, 86, 0.2)",
                                        "rgba(75, 192, 192, 0.2)",
                                        "rgba(153, 102, 255, 0.2)",
                                        "rgba(255, 159, 64, 0.2)",
                                    ],
                                    borderColor: [
                                        "rgba(255, 99, 132, 1)",
                                        "rgba(54, 162, 235, 1)",
                                        "rgba(255, 206, 86, 1)",
                                        "rgba(75, 192, 192, 1)",
                                        "rgba(153, 102, 255, 1)",
                                        "rgba(255, 159, 64, 1)",
                                    ],
                                },
                            ],
                        },
                        options: {
                            title: {
                                display: true,
                                text: "5 Sektor dengan Dampak Terbesar",
                            },
                            indexAxis: "y",
                            legend: {
                                display: false,
                            },
                            plugins: {
                                legend: {
                                    position: "right",
                                },
                                title: {
                                    display: true,
                                    text: "5 Sektor dengan Dampak Terbesar",
                                },
                            },
                            scales: {
                                xAxes: [
                                    {
                                        gridLines: {
                                            color: "rgba(0, 0, 0, 0)",
                                        },
                                    },
                                ],
                                yAxes: [
                                    {
                                        gridLines: {
                                            color: "rgba(0, 0, 0, 0)",
                                        },
                                        ticks: { mirror: true },
                                    },
                                ],
                            },
                        },
                    }
                );
            },
        });
    };

    $("#nilaiInvestasiKeterkaitanHuluHilir").on("keyup", (e) => {
        let nilai = parseInt(e.target.value.replaceAll(".", ""));
        let sektor =
            Math.round($("#sektorInputKeterkaitanHuluHilir").val() * 1000) /
            1000;
        let total = nilai * sektor;

        $(".inf-dampak-io-keterkaitan-hulu-hilir").html(
            separatorNum(Math.round(total))
        );

        get_chart_keterkaitan_hulu_hilir();
    });

    $("#sektorInputKeterkaitanHuluHilir").on("change", () => {
        let nilai = parseInt(
            $("#nilaiInvestasiKeterkaitanHuluHilir").val().replaceAll(".", "")
        );
        let sektor =
            Math.round($("#sektorInputKeterkaitanHuluHilir").val() * 1000) /
            1000;
        let total = nilai * sektor;

        $(".inf-dampak-io-keterkaitan-hulu-hilir").html(
            separatorNum(Math.round(total))
        );

        get_chart_keterkaitan_hulu_hilir();
    });
};

const getIOBruto = () => {
    $.ajax({
        url: `${url_api}/iobruto`,
        type: "POST",
        dataType: "json",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        success: (res) => {
            let { features } = res;
            let html = "";
            html += `<option value="0">Pilih Sektor</option>`;

            features.forEach(({ properties }) => {
                const { deskripsi, code } = properties;
                html += `<option value="${code}">${deskripsi}</option>`;
            });

            $("#sektorInputBruto").html(html);
            $("#sektorTerdampakInputBruto").html(html);

            $("#sektorInputBruto").change((e) => {
                let sektor = e.target.value;
                $.ajax({
                    url: `${url_api}/iobruto`,
                    type: "PUT",
                    dataType: "json",
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                    data: {
                        sektor_terdampak: $("#sektorTerdampakInputBruto").val(),
                        sektor: sektor,
                    },
                    success: (res) => {
                        const { koefisien } = res.features[0].properties;

                        // Save to local storage
                        localStorage.setItem("koefisien", koefisien);

                        $(".inf-koefisien-io-bruto").html(
                            Math.round(koefisien * 1000) / 1000
                        );

                        let nilai = parseInt(
                            $("#nilaiInvestasiBruto").val().replaceAll(".", "")
                        );
                        let total =
                            nilai * (Math.round(koefisien * 1000) / 1000);

                        $(".inf-dampak-io-bruto").html(
                            separatorNum(Math.round(total))
                        );
                    },
                });
            });

            $("#sektorTerdampakInputBruto").change((e) => {
                let sektor = e.target.value;
                $.ajax({
                    url: `${url_api}/iobruto`,
                    type: "PUT",
                    dataType: "json",
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                    data: {
                        sektor_terdampak: sektor,
                        sektor: $("#sektorInputBruto").val(),
                    },
                    success: (res) => {
                        const { koefisien } = res.features[0].properties;

                        // Save to local storage
                        localStorage.setItem("koefisien", koefisien);

                        $(".inf-koefisien-io-bruto").html(
                            Math.round(koefisien * 1000) / 1000
                        );

                        let nilai = parseInt(
                            $("#nilaiInvestasiBruto").val().replaceAll(".", "")
                        );
                        let total =
                            nilai * (Math.round(koefisien * 1000) / 1000);

                        $(".inf-dampak-io-bruto").html(
                            separatorNum(Math.round(total))
                        );
                    },
                });
            });

            $("#nilaiInvestasiBruto").keyup((e) => {
                let nilai = parseInt(e.target.value.replaceAll(".", ""));
                let koefisien = localStorage.getItem("koefisien");
                let total = nilai * (Math.round(koefisien * 1000) / 1000);

                $(".inf-dampak-io-bruto").html(separatorNum(Math.round(total)));
            });
        },
    });
};
