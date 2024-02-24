@extends('client.layout')

@section('title') Dashboard @endsection

@section('content')


        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card crm-widget">
                    <div class="card-body p-0">
                        <div class="row row-cols-xxl-5 row-cols-md-3 row-cols-1 g-0">
                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Campaign Sent <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ri-space-ship-line display-6 text-muted"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0"><span class="counter-value" data-target="197">197</span></h2>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <div class="col">
                                <div class="mt-3 mt-md-0 py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Annual Profit <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ri-exchange-dollar-line display-6 text-muted"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0">$<span class="counter-value" data-target="489.4">489.4</span>k</h2>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <div class="col">
                                <div class="mt-3 mt-md-0 py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Lead Conversation <i class="ri-arrow-down-circle-line text-danger fs-18 float-end align-middle"></i></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ri-pulse-line display-6 text-muted"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0"><span class="counter-value" data-target="32.89">32.89</span>%</h2>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <div class="col">
                                <div class="mt-3 mt-lg-0 py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Daily Average Income <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ri-trophy-line display-6 text-muted"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0">$<span class="counter-value" data-target="1596.5">1,596.5</span></h2>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <div class="col">
                                <div class="mt-3 mt-lg-0 py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Annual Deals <i class="ri-arrow-down-circle-line text-danger fs-18 float-end align-middle"></i></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ri-service-line display-6 text-muted"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0"><span class="counter-value" data-target="2659">2,659</span></h2>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-xxl-3 col-md-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Sales Forecast</h4>
                        <div class="flex-shrink-0">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Nov 2021<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Oct 2021</a>
                                    <a class="dropdown-item" href="#">Nov 2021</a>
                                    <a class="dropdown-item" href="#">Dec 2021</a>
                                    <a class="dropdown-item" href="#">Jan 2022</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body pb-0">
                        <div id="sales-forecast-chart" data-colors="[&quot;--vz-primary-rgb, 0.75&quot;, &quot;--vz-primary&quot;, &quot;--vz-primary-rgb, 0.55&quot;]" class="apex-charts" dir="ltr" style="min-height: 356px;"><div id="apexchartsflqkq1y9" class="apexcharts-canvas apexchartsflqkq1y9 apexcharts-theme-light" style="width: 349px; height: 341px;"><svg id="SvgjsSvg1001" width="349" height="341" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><foreignObject x="0" y="0" width="349" height="341"><div class="apexcharts-legend apexcharts-align-center apx-legend-position-bottom" xmlns="http://www.w3.org/1999/xhtml" style="inset: auto 0px 19px 20px; position: absolute; max-height: 170.5px;"><div class="apexcharts-legend-series" rel="1" seriesname="Goal" data:collapsed="false" style="margin: 0px 8px;"><span class="apexcharts-legend-marker" rel="1" data:collapsed="false" style="background: rgba(37, 160, 226, 0.75) !important; color: rgba(37, 160, 226, 0.75); height: 10px; width: 10px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 2px;"></span><span class="apexcharts-legend-text" rel="1" i="0" data:default-text="Goal" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 500; font-family: Helvetica, Arial, sans-serif;">Goal</span></div><div class="apexcharts-legend-series" rel="2" seriesname="PendingxForcast" data:collapsed="false" style="margin: 0px 8px;"><span class="apexcharts-legend-marker" rel="2" data:collapsed="false" style="background: rgb(37, 160, 226) !important; color: rgb(37, 160, 226); height: 10px; width: 10px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 2px;"></span><span class="apexcharts-legend-text" rel="2" i="1" data:default-text="Pending%20Forcast" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 500; font-family: Helvetica, Arial, sans-serif;">Pending Forcast</span></div><div class="apexcharts-legend-series" rel="3" seriesname="Revenue" data:collapsed="false" style="margin: 0px 8px;"><span class="apexcharts-legend-marker" rel="3" data:collapsed="false" style="background: rgba(37, 160, 226, 0.55) !important; color: rgba(37, 160, 226, 0.55); height: 10px; width: 10px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 2px;"></span><span class="apexcharts-legend-text" rel="3" i="2" data:default-text="Revenue" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 500; font-family: Helvetica, Arial, sans-serif;">Revenue</span></div></div><style type="text/css">

                                            .apexcharts-legend {
                                                display: flex;
                                                overflow: auto;
                                                padding: 0 10px;
                                            }
                                            .apexcharts-legend.apx-legend-position-bottom, .apexcharts-legend.apx-legend-position-top {
                                                flex-wrap: wrap
                                            }
                                            .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
                                                flex-direction: column;
                                                bottom: 0;
                                            }
                                            .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left, .apexcharts-legend.apx-legend-position-top.apexcharts-align-left, .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
                                                justify-content: flex-start;
                                            }
                                            .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center, .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
                                                justify-content: center;
                                            }
                                            .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right, .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
                                                justify-content: flex-end;
                                            }
                                            .apexcharts-legend-series {
                                                cursor: pointer;
                                                line-height: normal;
                                            }
                                            .apexcharts-legend.apx-legend-position-bottom .apexcharts-legend-series, .apexcharts-legend.apx-legend-position-top .apexcharts-legend-series{
                                                display: flex;
                                                align-items: center;
                                            }
                                            .apexcharts-legend-text {
                                                position: relative;
                                                font-size: 14px;
                                            }
                                            .apexcharts-legend-text *, .apexcharts-legend-marker * {
                                                pointer-events: none;
                                            }
                                            .apexcharts-legend-marker {
                                                position: relative;
                                                display: inline-block;
                                                cursor: pointer;
                                                margin-right: 3px;
                                                border-style: solid;
                                            }

                                            .apexcharts-legend.apexcharts-align-right .apexcharts-legend-series, .apexcharts-legend.apexcharts-align-left .apexcharts-legend-series{
                                                display: inline-block;
                                            }
                                            .apexcharts-legend-series.apexcharts-no-click {
                                                cursor: auto;
                                            }
                                            .apexcharts-legend .apexcharts-hidden-zero-series, .apexcharts-legend .apexcharts-hidden-null-series {
                                                display: none !important;
                                            }
                                            .apexcharts-inactive-legend {
                                                opacity: 0.45;
                                            }</style></foreignObject><g id="SvgjsG1066" class="apexcharts-yaxis" rel="0" transform="translate(21.86865234375, 0)"><g id="SvgjsG1067" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1069" font-family="Helvetica, Arial, sans-serif" x="20" y="31.4" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1070">$37k</tspan><title>$37k</title></text><text id="SvgjsText1072" font-family="Helvetica, Arial, sans-serif" x="20" y="87.147" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1073">$27.75k</tspan><title>$27.75k</title></text><text id="SvgjsText1075" font-family="Helvetica, Arial, sans-serif" x="20" y="142.894" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1076">$18.5k</tspan><title>$18.5k</title></text><text id="SvgjsText1078" font-family="Helvetica, Arial, sans-serif" x="20" y="198.641" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1079">$9.25k</tspan><title>$9.25k</title></text><text id="SvgjsText1081" font-family="Helvetica, Arial, sans-serif" x="20" y="254.388" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1082">$0k</tspan><title>$0k</title></text></g></g><g id="SvgjsG1003" class="apexcharts-inner apexcharts-graphical" transform="translate(51.86865234375, 30)"><defs id="SvgjsDefs1002"><linearGradient id="SvgjsLinearGradient1007" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1008" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop><stop id="SvgjsStop1009" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop><stop id="SvgjsStop1010" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop></linearGradient><clipPath id="gridRectMaskflqkq1y9"><rect id="SvgjsRect1012" width="296.13134765625" height="227.988" x="-4.5" y="-2.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskflqkq1y9"></clipPath><clipPath id="nonForecastMaskflqkq1y9"></clipPath><clipPath id="gridRectMarkerMaskflqkq1y9"><rect id="SvgjsRect1013" width="291.13134765625" height="226.988" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><rect id="SvgjsRect1011" width="62.2117919921875" height="222.988" x="44.36865234375" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient1007)" class="apexcharts-xcrosshairs" y2="222.988" filter="none" fill-opacity="0.9" x1="44.36865234375" x2="44.36865234375"></rect><g id="SvgjsG1045" class="apexcharts-grid"><g id="SvgjsG1046" class="apexcharts-gridlines-horizontal"><line id="SvgjsLine1050" x1="0" y1="55.747" x2="287.13134765625" y2="55.747" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1051" x1="0" y1="111.494" x2="287.13134765625" y2="111.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1052" x1="0" y1="167.24099999999999" x2="287.13134765625" y2="167.24099999999999" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG1047" class="apexcharts-gridlines-vertical"></g><line id="SvgjsLine1055" x1="0" y1="222.988" x2="287.13134765625" y2="222.988" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1054" x1="0" y1="1" x2="0" y2="222.988" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG1014" class="apexcharts-bar-series apexcharts-plot-series"><g id="SvgjsG1015" class="apexcharts-series" rel="1" seriesName="Goal" data:realIndex="0"><path id="SvgjsPath1020" d="M50.24798583984375 222.989L50.24798583984375 0.0010000000000331966L107.45977783203125 0.0010000000000331966L107.45977783203125 222.989L50.24798583984375 222.989C50.24798583984375 222.989 50.24798583984375 222.989 50.24798583984375 222.989C50.24798583984375 222.989 50.24798583984375 222.989 50.24798583984375 222.989C50.24798583984375 222.989 50.24798583984375 222.989 50.24798583984375 222.989C50.24798583984375 222.989 50.24798583984375 222.989 50.24798583984375 222.989 " fill="rgba(37,160,226, 0.75)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="round" stroke-width="5" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskflqkq1y9)" pathTo="M 50.24798583984375 222.989 L 50.24798583984375 0.0010000000000284217 L 107.45977783203125 0.0010000000000284217 L 107.45977783203125 222.989 Z" pathFrom="M 50.24798583984375 222.989 L 50.24798583984375 222.989 L 107.45977783203125 222.989 L 107.45977783203125 222.989 L 107.45977783203125 222.989 L 107.45977783203125 222.989 L 107.45977783203125 222.989 L 50.24798583984375 222.989 Z" cy="2.842170943040401e-14" cx="334.87933349609375" j="0" val="37" barHeight="222.98799999999997" barWidth="62.2117919921875"></path><g id="SvgjsG1017" class="apexcharts-bar-goals-markers" style="pointer-events: none"><g id="SvgjsG1019" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskflqkq1y9)"></g></g><g id="SvgjsG1018" class="apexcharts-bar-shadows apexcharts-hidden-element-shown" style="pointer-events: none"></g></g><g id="SvgjsG1025" class="apexcharts-series" rel="2" seriesName="PendingxForcast" data:realIndex="1"><path id="SvgjsPath1030" d="M112.45977783203125 222.989L112.45977783203125 150.66856756756758L169.67156982421875 150.66856756756758L169.67156982421875 222.989L112.45977783203125 222.989C112.45977783203125 222.989 112.45977783203125 222.989 112.45977783203125 222.989C112.45977783203125 222.989 112.45977783203125 222.989 112.45977783203125 222.989C112.45977783203125 222.989 112.45977783203125 222.989 112.45977783203125 222.989C112.45977783203125 222.989 112.45977783203125 222.989 112.45977783203125 222.989 " fill="rgba(37,160,226,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="round" stroke-width="5" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskflqkq1y9)" pathTo="M 112.45977783203125 222.989 L 112.45977783203125 150.66856756756758 L 169.67156982421875 150.66856756756758 L 169.67156982421875 222.989 Z" pathFrom="M 112.45977783203125 222.989 L 112.45977783203125 222.989 L 169.67156982421875 222.989 L 169.67156982421875 222.989 L 169.67156982421875 222.989 L 169.67156982421875 222.989 L 169.67156982421875 222.989 L 112.45977783203125 222.989 Z" cy="150.66756756756757" cx="397.09112548828125" j="0" val="12" barHeight="72.32043243243243" barWidth="62.2117919921875"></path><g id="SvgjsG1027" class="apexcharts-bar-goals-markers" style="pointer-events: none"><g id="SvgjsG1029" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskflqkq1y9)"></g></g><g id="SvgjsG1028" class="apexcharts-bar-shadows apexcharts-hidden-element-shown" style="pointer-events: none"></g></g><g id="SvgjsG1035" class="apexcharts-series" rel="3" seriesName="Revenue" data:realIndex="2"><path id="SvgjsPath1040" d="M174.67156982421875 222.989L174.67156982421875 114.50835135135137L231.88336181640625 114.50835135135137L231.88336181640625 222.989L174.67156982421875 222.989C174.67156982421875 222.989 174.67156982421875 222.989 174.67156982421875 222.989C174.67156982421875 222.989 174.67156982421875 222.989 174.67156982421875 222.989C174.67156982421875 222.989 174.67156982421875 222.989 174.67156982421875 222.989C174.67156982421875 222.989 174.67156982421875 222.989 174.67156982421875 222.989 " fill="rgba(37,160,226, 0.55)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="round" stroke-width="5" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMaskflqkq1y9)" pathTo="M 174.67156982421875 222.989 L 174.67156982421875 114.50835135135137 L 231.88336181640625 114.50835135135137 L 231.88336181640625 222.989 Z" pathFrom="M 174.67156982421875 222.989 L 174.67156982421875 222.989 L 231.88336181640625 222.989 L 231.88336181640625 222.989 L 231.88336181640625 222.989 L 231.88336181640625 222.989 L 231.88336181640625 222.989 L 174.67156982421875 222.989 Z" cy="114.50735135135136" cx="459.30291748046875" j="0" val="18" barHeight="108.48064864864864" barWidth="62.2117919921875"></path><g id="SvgjsG1037" class="apexcharts-bar-goals-markers" style="pointer-events: none"><g id="SvgjsG1039" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskflqkq1y9)"></g></g><g id="SvgjsG1038" class="apexcharts-bar-shadows apexcharts-hidden-element-shown" style="pointer-events: none"></g></g><g id="SvgjsG1016" class="apexcharts-datalabels apexcharts-hidden-element-shown" data:realIndex="0"><g id="SvgjsG1022" class="apexcharts-data-labels" transform="rotate(0)"><text id="SvgjsText1024" font-family="Helvetica, Arial, sans-serif" x="78.8538818359375" y="119.99400000000001" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-datalabel" cx="78.8538818359375" cy="119.99400000000001" style="font-family: Helvetica, Arial, sans-serif;">37</text></g></g><g id="SvgjsG1026" class="apexcharts-datalabels apexcharts-hidden-element-shown" data:realIndex="1"><g id="SvgjsG1032" class="apexcharts-data-labels" transform="rotate(0)"><text id="SvgjsText1034" font-family="Helvetica, Arial, sans-serif" x="141.065673828125" y="195.3277837837838" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-datalabel" cx="141.065673828125" cy="195.3277837837838" style="font-family: Helvetica, Arial, sans-serif;">12</text></g></g><g id="SvgjsG1036" class="apexcharts-datalabels apexcharts-hidden-element-shown" data:realIndex="2"><g id="SvgjsG1042" class="apexcharts-data-labels" transform="rotate(0)"><text id="SvgjsText1044" font-family="Helvetica, Arial, sans-serif" x="203.2774658203125" y="177.24767567567568" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-datalabel" cx="203.2774658203125" cy="177.24767567567568" style="font-family: Helvetica, Arial, sans-serif;">18</text></g></g></g><g id="SvgjsG1048" class="apexcharts-grid-borders"><line id="SvgjsLine1049" x1="0" y1="0" x2="287.13134765625" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1053" x1="0" y1="222.988" x2="287.13134765625" y2="222.988" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1065" x1="0" y1="223.988" x2="287.13134765625" y2="223.988" stroke="#e0e0e0" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"></line></g><line id="SvgjsLine1056" x1="0" y1="0" x2="287.13134765625" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1057" x1="0" y1="0" x2="287.13134765625" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1058" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1059" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1061" font-family="Helvetica, Arial, sans-serif" x="143.565673828125" y="251.988" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1062"></tspan><title></title></text></g><g id="SvgjsG1063" class="apexcharts-xaxis-title"><text id="SvgjsText1064" font-family="Helvetica, Arial, sans-serif" x="143.565673828125" y="254" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#78909c" class="apexcharts-text apexcharts-xaxis-title-text " style="font-family: Helvetica, Arial, sans-serif;">Total Forecasted Value</text></g></g><g id="SvgjsG1083" class="apexcharts-yaxis-annotations apexcharts-hidden-element-shown"></g><g id="SvgjsG1084" class="apexcharts-xaxis-annotations apexcharts-hidden-element-shown"></g><g id="SvgjsG1085" class="apexcharts-point-annotations apexcharts-hidden-element-shown"></g></g></svg><div class="apexcharts-tooltip apexcharts-theme-light" style="left: 127.343px; top: 14.5px;"><div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group apexcharts-active" style="order: 1; display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: rgba(37, 160, 226, 0.75);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label">Goal: </span><span class="apexcharts-tooltip-text-y-value">$37k</span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 2; display: none;"><span class="apexcharts-tooltip-marker" style="background-color: rgba(37, 160, 226, 0.75);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label">Goal: </span><span class="apexcharts-tooltip-text-y-value">$37k</span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 3; display: none;"><span class="apexcharts-tooltip-marker" style="background-color: rgba(37, 160, 226, 0.75);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label">Goal: </span><span class="apexcharts-tooltip-text-y-value">$37k</span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                    </div>
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xxl-3 col-md-6">
                <div class="card card-height-100">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Deal Type</h4>
                        <div class="flex-shrink-0">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Monthly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Today</a>
                                    <a class="dropdown-item" href="#">Weekly</a>
                                    <a class="dropdown-item" href="#">Monthly</a>
                                    <a class="dropdown-item" href="#">Yearly</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body pb-0">
                        <div id="deal-type-charts" data-colors="[&quot;--vz-primary-rgb, 0.15&quot;, &quot;--vz-primary-rgb, 0.35&quot;, &quot;--vz-primary-rgb, 0.45&quot;]" class="apex-charts" dir="ltr" style="min-height: 356px;"><div id="apexchartsld2jxb9x" class="apexcharts-canvas apexchartsld2jxb9x apexcharts-theme-light" style="width: 349px; height: 341px;"><svg id="SvgjsSvg1086" width="349" height="341" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><foreignObject x="0" y="0" width="349" height="341"><div class="apexcharts-legend apexcharts-align-center apx-legend-position-bottom" xmlns="http://www.w3.org/1999/xhtml" style="inset: auto 0px 13px 20px; position: absolute; max-height: 170.5px;"><div class="apexcharts-legend-series" rel="1" seriesname="Pending" data:collapsed="false" style="margin: 0px 10px;"><span class="apexcharts-legend-marker" rel="1" data:collapsed="false" style="background: rgba(37, 160, 226, 0.15) !important; color: rgba(37, 160, 226, 0.15); height: 8px; width: 8px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 6px;"></span><span class="apexcharts-legend-text" rel="1" i="0" data:default-text="Pending" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 500; font-family: Helvetica, Arial, sans-serif;">Pending</span></div><div class="apexcharts-legend-series" rel="2" seriesname="Loss" data:collapsed="false" style="margin: 0px 10px;"><span class="apexcharts-legend-marker" rel="2" data:collapsed="false" style="background: rgba(37, 160, 226, 0.35) !important; color: rgba(37, 160, 226, 0.35); height: 8px; width: 8px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 6px;"></span><span class="apexcharts-legend-text" rel="2" i="1" data:default-text="Loss" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 500; font-family: Helvetica, Arial, sans-serif;">Loss</span></div><div class="apexcharts-legend-series" rel="3" seriesname="Won" data:collapsed="false" style="margin: 0px 10px;"><span class="apexcharts-legend-marker" rel="3" data:collapsed="false" style="background: rgba(37, 160, 226, 0.45) !important; color: rgba(37, 160, 226, 0.45); height: 8px; width: 8px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 6px;"></span><span class="apexcharts-legend-text" rel="3" i="2" data:default-text="Won" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 500; font-family: Helvetica, Arial, sans-serif;">Won</span></div></div><style type="text/css">

                                            .apexcharts-legend {
                                                display: flex;
                                                overflow: auto;
                                                padding: 0 10px;
                                            }
                                            .apexcharts-legend.apx-legend-position-bottom, .apexcharts-legend.apx-legend-position-top {
                                                flex-wrap: wrap
                                            }
                                            .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
                                                flex-direction: column;
                                                bottom: 0;
                                            }
                                            .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left, .apexcharts-legend.apx-legend-position-top.apexcharts-align-left, .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
                                                justify-content: flex-start;
                                            }
                                            .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center, .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
                                                justify-content: center;
                                            }
                                            .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right, .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
                                                justify-content: flex-end;
                                            }
                                            .apexcharts-legend-series {
                                                cursor: pointer;
                                                line-height: normal;
                                            }
                                            .apexcharts-legend.apx-legend-position-bottom .apexcharts-legend-series, .apexcharts-legend.apx-legend-position-top .apexcharts-legend-series{
                                                display: flex;
                                                align-items: center;
                                            }
                                            .apexcharts-legend-text {
                                                position: relative;
                                                font-size: 14px;
                                            }
                                            .apexcharts-legend-text *, .apexcharts-legend-marker * {
                                                pointer-events: none;
                                            }
                                            .apexcharts-legend-marker {
                                                position: relative;
                                                display: inline-block;
                                                cursor: pointer;
                                                margin-right: 3px;
                                                border-style: solid;
                                            }

                                            .apexcharts-legend.apexcharts-align-right .apexcharts-legend-series, .apexcharts-legend.apexcharts-align-left .apexcharts-legend-series{
                                                display: inline-block;
                                            }
                                            .apexcharts-legend-series.apexcharts-no-click {
                                                cursor: auto;
                                            }
                                            .apexcharts-legend .apexcharts-hidden-zero-series, .apexcharts-legend .apexcharts-hidden-null-series {
                                                display: none !important;
                                            }
                                            .apexcharts-inactive-legend {
                                                opacity: 0.45;
                                            }</style></foreignObject><g id="SvgjsG1088" class="apexcharts-inner apexcharts-graphical" transform="translate(14, 30)"><defs id="SvgjsDefs1087"><clipPath id="gridRectMaskld2jxb9x"><rect id="SvgjsRect1091" width="319.4140625" height="255" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskld2jxb9x"></clipPath><clipPath id="nonForecastMaskld2jxb9x"></clipPath><clipPath id="gridRectMarkerMaskld2jxb9x"><rect id="SvgjsRect1092" width="317.4140625" height="257" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><filter id="SvgjsFilter1100" width="200%" height="200%" x="-50%" y="-50%"><feFlood id="SvgjsFeFlood1101" flood-color="#000000" flood-opacity="0.35" result="SvgjsFeFlood1101Out" in="SourceGraphic"></feFlood><feComposite id="SvgjsFeComposite1102" in="SvgjsFeFlood1101Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1102Out"></feComposite><feOffset id="SvgjsFeOffset1103" dx="1" dy="1" result="SvgjsFeOffset1103Out" in="SvgjsFeComposite1102Out"></feOffset><feGaussianBlur id="SvgjsFeGaussianBlur1104" stdDeviation="1 " result="SvgjsFeGaussianBlur1104Out" in="SvgjsFeOffset1103Out"></feGaussianBlur><feMerge id="SvgjsFeMerge1105" result="SvgjsFeMerge1105Out" in="SourceGraphic"><feMergeNode id="SvgjsFeMergeNode1106" in="SvgjsFeGaussianBlur1104Out"></feMergeNode><feMergeNode id="SvgjsFeMergeNode1107" in="[object Arguments]"></feMergeNode></feMerge><feBlend id="SvgjsFeBlend1108" in="SourceGraphic" in2="SvgjsFeMerge1105Out" mode="normal" result="SvgjsFeBlend1108Out"></feBlend></filter><filter id="SvgjsFilter1126" width="200%" height="200%" x="-50%" y="-50%"><feFlood id="SvgjsFeFlood1127" flood-color="#000000" flood-opacity="0.35" result="SvgjsFeFlood1127Out" in="SourceGraphic"></feFlood><feComposite id="SvgjsFeComposite1128" in="SvgjsFeFlood1127Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1128Out"></feComposite><feOffset id="SvgjsFeOffset1129" dx="1" dy="1" result="SvgjsFeOffset1129Out" in="SvgjsFeComposite1128Out"></feOffset><feGaussianBlur id="SvgjsFeGaussianBlur1130" stdDeviation="1 " result="SvgjsFeGaussianBlur1130Out" in="SvgjsFeOffset1129Out"></feGaussianBlur><feMerge id="SvgjsFeMerge1131" result="SvgjsFeMerge1131Out" in="SourceGraphic"><feMergeNode id="SvgjsFeMergeNode1132" in="SvgjsFeGaussianBlur1130Out"></feMergeNode><feMergeNode id="SvgjsFeMergeNode1133" in="[object Arguments]"></feMergeNode></feMerge><feBlend id="SvgjsFeBlend1134" in="SourceGraphic" in2="SvgjsFeMerge1131Out" mode="normal" result="SvgjsFeBlend1134Out"></feBlend></filter><filter id="SvgjsFilter1152" width="200%" height="200%" x="-50%" y="-50%"><feFlood id="SvgjsFeFlood1153" flood-color="#000000" flood-opacity="0.35" result="SvgjsFeFlood1153Out" in="SourceGraphic"></feFlood><feComposite id="SvgjsFeComposite1154" in="SvgjsFeFlood1153Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1154Out"></feComposite><feOffset id="SvgjsFeOffset1155" dx="1" dy="1" result="SvgjsFeOffset1155Out" in="SvgjsFeComposite1154Out"></feOffset><feGaussianBlur id="SvgjsFeGaussianBlur1156" stdDeviation="1 " result="SvgjsFeGaussianBlur1156Out" in="SvgjsFeOffset1155Out"></feGaussianBlur><feMerge id="SvgjsFeMerge1157" result="SvgjsFeMerge1157Out" in="SourceGraphic"><feMergeNode id="SvgjsFeMergeNode1158" in="SvgjsFeGaussianBlur1156Out"></feMergeNode><feMergeNode id="SvgjsFeMergeNode1159" in="[object Arguments]"></feMergeNode></feMerge><feBlend id="SvgjsFeBlend1160" in="SourceGraphic" in2="SvgjsFeMerge1157Out" mode="normal" result="SvgjsFeBlend1160Out"></feBlend></filter></defs><g id="SvgjsG1196" class="apexcharts-grid"><g id="SvgjsG1197" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1200" x1="0" y1="0" x2="313.4140625" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1201" x1="0" y1="63.25" x2="313.4140625" y2="63.25" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1202" x1="0" y1="126.5" x2="313.4140625" y2="126.5" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1203" x1="0" y1="189.75" x2="313.4140625" y2="189.75" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1204" x1="0" y1="253" x2="313.4140625" y2="253" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG1198" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1206" x1="0" y1="253" x2="313.4140625" y2="253" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1205" x1="0" y1="1" x2="0" y2="253" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG1093" class="apexcharts-radar-series apexcharts-plot-series" transform="translate(156.70703125, 126.5)"><polygon id="SvgjsPolygon1179" points="0,-128.0922619047619 110.93115283773348,-64.04613095238096 110.93115283773349,64.04613095238092 1.5686777853721112e-14,128.0922619047619 -110.93115283773345,64.046130952381 -110.93115283773353,-64.04613095238086 " fill="none" stroke="#e8e8e8" stroke-width="1"></polygon><polygon id="SvgjsPolygon1180" points="0,-96.06919642857142 83.19836462830011,-48.03459821428572 83.19836462830011,48.03459821428569 1.1765083390290833e-14,96.06919642857142 -83.19836462830008,48.03459821428575 -83.19836462830015,-48.034598214285644 " fill="none" stroke="#e8e8e8" stroke-width="1"></polygon><polygon id="SvgjsPolygon1181" points="0,-64.04613095238095 55.46557641886674,-32.02306547619048 55.465576418866746,32.02306547619046 7.843388926860556e-15,64.04613095238095 -55.465576418866725,32.0230654761905 -55.46557641886677,-32.02306547619043 " fill="none" stroke="#e8e8e8" stroke-width="1"></polygon><polygon id="SvgjsPolygon1182" points="0,-32.023065476190474 27.73278820943337,-16.01153273809524 27.732788209433373,16.01153273809523 3.921694463430278e-15,32.023065476190474 -27.732788209433362,16.01153273809525 -27.732788209433384,-16.011532738095216 " fill="none" stroke="#e8e8e8" stroke-width="1"></polygon><polygon id="SvgjsPolygon1183" points="0,0 0,0 0,0 0,0 0,0 0,0 " fill="none" stroke="#e8e8e8" stroke-width="1"></polygon><line id="SvgjsLine1173" x1="0" y1="-128.0922619047619" x2="0" y2="0" stroke="#e8e8e8" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1174" x1="110.93115283773348" y1="-64.04613095238096" x2="0" y2="0" stroke="#e8e8e8" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1175" x1="110.93115283773349" y1="64.04613095238092" x2="0" y2="0" stroke="#e8e8e8" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1176" x1="1.5686777853721112e-14" y1="128.0922619047619" x2="0" y2="0" stroke="#e8e8e8" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1177" x1="-110.93115283773345" y1="64.046130952381" x2="0" y2="0" stroke="#e8e8e8" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1178" x1="-110.93115283773353" y1="-64.04613095238086" x2="0" y2="0" stroke="#e8e8e8" stroke-dasharray="0" stroke-linecap="butt"></line><g id="SvgjsG1189" class="apexcharts-xaxis"><text id="SvgjsText1190" font-family="Helvetica, Arial, sans-serif" x="0" y="-138.0922619047619" text-anchor="middle" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#a8a8a8" class="apexcharts-datalabel" cx="0" cy="-138.0922619047619" style="font-family: Helvetica, Arial, sans-serif;">2016</text><text id="SvgjsText1191" font-family="Helvetica, Arial, sans-serif" x="120.93115283773348" y="-64.04613095238096" text-anchor="start" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#a8a8a8" class="apexcharts-datalabel" cx="120.93115283773348" cy="-64.04613095238096" style="font-family: Helvetica, Arial, sans-serif;">2017</text><text id="SvgjsText1192" font-family="Helvetica, Arial, sans-serif" x="120.93115283773349" y="64.04613095238092" text-anchor="start" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#a8a8a8" class="apexcharts-datalabel" cx="120.93115283773349" cy="64.04613095238092" style="font-family: Helvetica, Arial, sans-serif;">2018</text><text id="SvgjsText1193" font-family="Helvetica, Arial, sans-serif" x="1.5686777853721112e-14" y="138.0922619047619" text-anchor="middle" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#a8a8a8" class="apexcharts-datalabel" cx="1.5686777853721112e-14" cy="138.0922619047619" style="font-family: Helvetica, Arial, sans-serif;">2019</text><text id="SvgjsText1194" font-family="Helvetica, Arial, sans-serif" x="-120.93115283773345" y="64.046130952381" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#a8a8a8" class="apexcharts-datalabel" cx="-120.93115283773345" cy="64.046130952381" style="font-family: Helvetica, Arial, sans-serif;">2020</text><text id="SvgjsText1195" font-family="Helvetica, Arial, sans-serif" x="-120.93115283773353" y="-64.04613095238086" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#a8a8a8" class="apexcharts-datalabel" cx="-120.93115283773353" cy="-64.04613095238086" style="font-family: Helvetica, Arial, sans-serif;">2021</text></g><g id="SvgjsG1095" class="apexcharts-series" data:longestSeries="true" seriesName="Pending" rel="1" data:realIndex="0"><path id="SvgjsPath1098" d="M0 -85.39484126984127C0 -85.39484126984127 0 -85.39484126984127 0 -85.39484126984127C0 -85.39484126984127 46.22131368238895 -26.685887896825403 46.22131368238895 -26.685887896825403C46.22131368238895 -26.685887896825403 27.732788209433373 16.01153273809523 27.732788209433373 16.01153273809523C27.732788209433373 16.01153273809523 5.2289259512403705e-15 42.69742063492063 5.2289259512403705e-15 42.69742063492063C5.2289259512403705e-15 42.69742063492063 -92.44262736477788 53.37177579365084 -92.44262736477788 53.37177579365084C-92.44262736477788 53.37177579365084 -18.48852547295559 -10.674355158730144 -18.48852547295559 -10.674355158730144C-18.48852547295559 -10.674355158730144 0 -85.39484126984127 0 -85.39484126984127 " fill="none" fill-opacity="1" stroke="rgba(37,160,226, 0.15)" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-radar" index="0" pathTo="M 0 -85.39484126984127 L 0 -85.39484126984127 L 46.22131368238895 -26.685887896825403 L 27.732788209433373 16.01153273809523 L 5.2289259512403705e-15 42.69742063492063 L -92.44262736477788 53.37177579365084 L -18.48852547295559 -10.674355158730144Z" pathFrom="M 0 0"></path><path id="SvgjsPath1099" d="M0 -85.39484126984127C0 -85.39484126984127 0 -85.39484126984127 0 -85.39484126984127C0 -85.39484126984127 46.22131368238895 -26.685887896825403 46.22131368238895 -26.685887896825403C46.22131368238895 -26.685887896825403 27.732788209433373 16.01153273809523 27.732788209433373 16.01153273809523C27.732788209433373 16.01153273809523 5.2289259512403705e-15 42.69742063492063 5.2289259512403705e-15 42.69742063492063C5.2289259512403705e-15 42.69742063492063 -92.44262736477788 53.37177579365084 -92.44262736477788 53.37177579365084C-92.44262736477788 53.37177579365084 -18.48852547295559 -10.674355158730144 -18.48852547295559 -10.674355158730144C-18.48852547295559 -10.674355158730144 0 -85.39484126984127 0 -85.39484126984127 " fill="rgba(37,160,226, 0.15)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-radar" index="0" pathTo="M 0 -85.39484126984127 L 0 -85.39484126984127 L 46.22131368238895 -26.685887896825403 L 27.732788209433373 16.01153273809523 L 5.2289259512403705e-15 42.69742063492063 L -92.44262736477788 53.37177579365084 L -18.48852547295559 -10.674355158730144Z" pathFrom="M 0 0" filter="url(#SvgjsFilter1100)"></path><g id="SvgjsG1096" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown"><g id="SvgjsG1110" class="apexcharts-series-markers"><circle id="SvgjsCircle1109" r="0" cx="0" cy="-85.39484126984127" class="apexcharts-marker" stroke="#ffffff" fill="rgba(37,160,226, 0.15)" fill-opacity="1" stroke-width="1" stroke-opacity="1" rel="0" j="0" index="0" default-marker-size="0"></circle></g><g id="SvgjsG1112" class="apexcharts-series-markers"><circle id="SvgjsCircle1111" r="0" cx="46.22131368238895" cy="-26.685887896825403" class="apexcharts-marker" stroke="#ffffff" fill="rgba(37,160,226, 0.15)" fill-opacity="1" stroke-width="1" stroke-opacity="1" rel="1" j="1" index="0" default-marker-size="0"></circle></g><g id="SvgjsG1114" class="apexcharts-series-markers"><circle id="SvgjsCircle1113" r="0" cx="27.732788209433373" cy="16.01153273809523" class="apexcharts-marker" stroke="#ffffff" fill="rgba(37,160,226, 0.15)" fill-opacity="1" stroke-width="1" stroke-opacity="1" rel="2" j="2" index="0" default-marker-size="0"></circle></g><g id="SvgjsG1116" class="apexcharts-series-markers"><circle id="SvgjsCircle1115" r="0" cx="5.2289259512403705e-15" cy="42.69742063492063" class="apexcharts-marker" stroke="#ffffff" fill="rgba(37,160,226, 0.15)" fill-opacity="1" stroke-width="1" stroke-opacity="1" rel="3" j="3" index="0" default-marker-size="0"></circle></g><g id="SvgjsG1118" class="apexcharts-series-markers"><circle id="SvgjsCircle1117" r="0" cx="-92.44262736477788" cy="53.37177579365084" class="apexcharts-marker" stroke="#ffffff" fill="rgba(37,160,226, 0.15)" fill-opacity="1" stroke-width="1" stroke-opacity="1" rel="4" j="4" index="0" default-marker-size="0"></circle></g><g id="SvgjsG1120" class="apexcharts-series-markers"><circle id="SvgjsCircle1119" r="0" cx="-18.48852547295559" cy="-10.674355158730144" class="apexcharts-marker" stroke="#ffffff" fill="rgba(37,160,226, 0.15)" fill-opacity="1" stroke-width="1" stroke-opacity="1" rel="5" j="5" index="0" default-marker-size="0"></circle></g><g class="apexcharts-series-markers"><circle id="SvgjsCircle1212" r="0" cx="0" cy="0" class="apexcharts-marker wky3ex5e3" stroke="#ffffff" fill="rgba(37,160,226, 0.15)" fill-opacity="1" stroke-width="1" stroke-opacity="1" default-marker-size="0"></circle></g></g></g><g id="SvgjsG1121" class="apexcharts-series" data:longestSeries="true" seriesName="Loss" rel="2" data:realIndex="1"><path id="SvgjsPath1124" d="M0 -21.348710317460316C0 -21.348710317460316 0 -21.348710317460316 0 -21.348710317460316C0 -21.348710317460316 27.73278820943337 -16.01153273809524 27.73278820943337 -16.01153273809524C27.73278820943337 -16.01153273809524 36.97705094591117 21.348710317460306 36.97705094591117 21.348710317460306C36.97705094591117 21.348710317460306 1.0457851902480741e-14 85.39484126984127 1.0457851902480741e-14 85.39484126984127C1.0457851902480741e-14 85.39484126984127 -18.488525472955576 10.674355158730167 -18.488525472955576 10.674355158730167C-18.488525472955576 10.674355158730167 -73.95410189182236 -42.697420634920576 -73.95410189182236 -42.697420634920576C-73.95410189182236 -42.697420634920576 0 -21.348710317460316 0 -21.348710317460316 " fill="none" fill-opacity="1" stroke="rgba(37,160,226, 0.35)" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-radar" index="1" pathTo="M 0 -21.348710317460316 L 0 -21.348710317460316 L 27.73278820943337 -16.01153273809524 L 36.97705094591117 21.348710317460306 L 1.0457851902480741e-14 85.39484126984127 L -18.488525472955576 10.674355158730167 L -73.95410189182236 -42.697420634920576Z" pathFrom="M 0 0"></path><path id="SvgjsPath1125" d="M0 -21.348710317460316C0 -21.348710317460316 0 -21.348710317460316 0 -21.348710317460316C0 -21.348710317460316 27.73278820943337 -16.01153273809524 27.73278820943337 -16.01153273809524C27.73278820943337 -16.01153273809524 36.97705094591117 21.348710317460306 36.97705094591117 21.348710317460306C36.97705094591117 21.348710317460306 1.0457851902480741e-14 85.39484126984127 1.0457851902480741e-14 85.39484126984127C1.0457851902480741e-14 85.39484126984127 -18.488525472955576 10.674355158730167 -18.488525472955576 10.674355158730167C-18.488525472955576 10.674355158730167 -73.95410189182236 -42.697420634920576 -73.95410189182236 -42.697420634920576C-73.95410189182236 -42.697420634920576 0 -21.348710317460316 0 -21.348710317460316 " fill="rgba(37,160,226, 0.35)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-radar" index="1" pathTo="M 0 -21.348710317460316 L 0 -21.348710317460316 L 27.73278820943337 -16.01153273809524 L 36.97705094591117 21.348710317460306 L 1.0457851902480741e-14 85.39484126984127 L -18.488525472955576 10.674355158730167 L -73.95410189182236 -42.697420634920576Z" pathFrom="M 0 0" filter="url(#SvgjsFilter1126)"></path><g id="SvgjsG1122" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown"><g id="SvgjsG1136" class="apexcharts-series-markers"><circle id="SvgjsCircle1135" r="0" cx="0" cy="-21.348710317460316" class="apexcharts-marker" stroke="#ffffff" fill="rgba(37,160,226, 0.35)" fill-opacity="1" stroke-width="1" stroke-opacity="1" rel="0" j="0" index="1" default-marker-size="0"></circle></g><g id="SvgjsG1138" class="apexcharts-series-markers"><circle id="SvgjsCircle1137" r="0" cx="27.73278820943337" cy="-16.01153273809524" class="apexcharts-marker" stroke="#ffffff" fill="rgba(37,160,226, 0.35)" fill-opacity="1" stroke-width="1" stroke-opacity="1" rel="1" j="1" index="1" default-marker-size="0"></circle></g><g id="SvgjsG1140" class="apexcharts-series-markers"><circle id="SvgjsCircle1139" r="0" cx="36.97705094591117" cy="21.348710317460306" class="apexcharts-marker" stroke="#ffffff" fill="rgba(37,160,226, 0.35)" fill-opacity="1" stroke-width="1" stroke-opacity="1" rel="2" j="2" index="1" default-marker-size="0"></circle></g><g id="SvgjsG1142" class="apexcharts-series-markers"><circle id="SvgjsCircle1141" r="0" cx="1.0457851902480741e-14" cy="85.39484126984127" class="apexcharts-marker" stroke="#ffffff" fill="rgba(37,160,226, 0.35)" fill-opacity="1" stroke-width="1" stroke-opacity="1" rel="3" j="3" index="1" default-marker-size="0"></circle></g><g id="SvgjsG1144" class="apexcharts-series-markers"><circle id="SvgjsCircle1143" r="0" cx="-18.488525472955576" cy="10.674355158730167" class="apexcharts-marker" stroke="#ffffff" fill="rgba(37,160,226, 0.35)" fill-opacity="1" stroke-width="1" stroke-opacity="1" rel="4" j="4" index="1" default-marker-size="0"></circle></g><g id="SvgjsG1146" class="apexcharts-series-markers"><circle id="SvgjsCircle1145" r="0" cx="-73.95410189182236" cy="-42.697420634920576" class="apexcharts-marker" stroke="#ffffff" fill="rgba(37,160,226, 0.35)" fill-opacity="1" stroke-width="1" stroke-opacity="1" rel="5" j="5" index="1" default-marker-size="0"></circle></g><g class="apexcharts-series-markers"><circle id="SvgjsCircle1213" r="0" cx="0" cy="0" class="apexcharts-marker wi55s2xem" stroke="#ffffff" fill="rgba(37,160,226, 0.15)" fill-opacity="1" stroke-width="1" stroke-opacity="1" default-marker-size="0"></circle></g></g></g><g id="SvgjsG1147" class="apexcharts-series" data:longestSeries="true" seriesName="Won" rel="3" data:realIndex="2"><path id="SvgjsPath1150" d="M0 -46.96716269841269C0 -46.96716269841269 0 -46.96716269841269 0 -46.96716269841269C0 -46.96716269841269 70.2563967972312 -40.56254960317461 70.2563967972312 -40.56254960317461C70.2563967972312 -40.56254960317461 72.10524934452677 41.629985119047596 72.10524934452677 41.629985119047596C72.10524934452677 41.629985119047596 1.6994009341531203e-15 13.876661706349205 1.6994009341531203e-15 13.876661706349205C1.6994009341531203e-15 13.876661706349205 -39.750329766854485 22.94986359126986 -39.750329766854485 22.94986359126986C-39.750329766854485 22.94986359126986 -9.244262736477795 -5.337177579365072 -9.244262736477795 -5.337177579365072C-9.244262736477795 -5.337177579365072 0 -46.96716269841269 0 -46.96716269841269 " fill="none" fill-opacity="1" stroke="rgba(37,160,226, 0.45)" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-radar" index="2" pathTo="M 0 -46.96716269841269 L 0 -46.96716269841269 L 70.2563967972312 -40.56254960317461 L 72.10524934452677 41.629985119047596 L 1.6994009341531203e-15 13.876661706349205 L -39.750329766854485 22.94986359126986 L -9.244262736477795 -5.337177579365072Z" pathFrom="M 0 0"></path><path id="SvgjsPath1151" d="M0 -46.96716269841269C0 -46.96716269841269 0 -46.96716269841269 0 -46.96716269841269C0 -46.96716269841269 70.2563967972312 -40.56254960317461 70.2563967972312 -40.56254960317461C70.2563967972312 -40.56254960317461 72.10524934452677 41.629985119047596 72.10524934452677 41.629985119047596C72.10524934452677 41.629985119047596 1.6994009341531203e-15 13.876661706349205 1.6994009341531203e-15 13.876661706349205C1.6994009341531203e-15 13.876661706349205 -39.750329766854485 22.94986359126986 -39.750329766854485 22.94986359126986C-39.750329766854485 22.94986359126986 -9.244262736477795 -5.337177579365072 -9.244262736477795 -5.337177579365072C-9.244262736477795 -5.337177579365072 0 -46.96716269841269 0 -46.96716269841269 " fill="rgba(37,160,226, 0.45)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-radar" index="2" pathTo="M 0 -46.96716269841269 L 0 -46.96716269841269 L 70.2563967972312 -40.56254960317461 L 72.10524934452677 41.629985119047596 L 1.6994009341531203e-15 13.876661706349205 L -39.750329766854485 22.94986359126986 L -9.244262736477795 -5.337177579365072Z" pathFrom="M 0 0" filter="url(#SvgjsFilter1152)"></path><g id="SvgjsG1148" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown"><g id="SvgjsG1162" class="apexcharts-series-markers"><circle id="SvgjsCircle1161" r="0" cx="0" cy="-46.96716269841269" class="apexcharts-marker" stroke="#ffffff" fill="rgba(37,160,226, 0.45)" fill-opacity="1" stroke-width="1" stroke-opacity="1" rel="0" j="0" index="2" default-marker-size="0"></circle></g><g id="SvgjsG1164" class="apexcharts-series-markers"><circle id="SvgjsCircle1163" r="0" cx="70.2563967972312" cy="-40.56254960317461" class="apexcharts-marker" stroke="#ffffff" fill="rgba(37,160,226, 0.45)" fill-opacity="1" stroke-width="1" stroke-opacity="1" rel="1" j="1" index="2" default-marker-size="0"></circle></g><g id="SvgjsG1166" class="apexcharts-series-markers"><circle id="SvgjsCircle1165" r="0" cx="72.10524934452677" cy="41.629985119047596" class="apexcharts-marker" stroke="#ffffff" fill="rgba(37,160,226, 0.45)" fill-opacity="1" stroke-width="1" stroke-opacity="1" rel="2" j="2" index="2" default-marker-size="0"></circle></g><g id="SvgjsG1168" class="apexcharts-series-markers"><circle id="SvgjsCircle1167" r="0" cx="1.6994009341531203e-15" cy="13.876661706349205" class="apexcharts-marker" stroke="#ffffff" fill="rgba(37,160,226, 0.45)" fill-opacity="1" stroke-width="1" stroke-opacity="1" rel="3" j="3" index="2" default-marker-size="0"></circle></g><g id="SvgjsG1170" class="apexcharts-series-markers"><circle id="SvgjsCircle1169" r="0" cx="-39.750329766854485" cy="22.94986359126986" class="apexcharts-marker" stroke="#ffffff" fill="rgba(37,160,226, 0.45)" fill-opacity="1" stroke-width="1" stroke-opacity="1" rel="4" j="4" index="2" default-marker-size="0"></circle></g><g id="SvgjsG1172" class="apexcharts-series-markers"><circle id="SvgjsCircle1171" r="0" cx="-9.244262736477795" cy="-5.337177579365072" class="apexcharts-marker" stroke="#ffffff" fill="rgba(37,160,226, 0.45)" fill-opacity="1" stroke-width="1" stroke-opacity="1" rel="5" j="5" index="2" default-marker-size="0"></circle></g><g class="apexcharts-series-markers"><circle id="SvgjsCircle1214" r="0" cx="0" cy="0" class="apexcharts-marker whwcuq5z5" stroke="#ffffff" fill="rgba(37,160,226, 0.15)" fill-opacity="1" stroke-width="1" stroke-opacity="1" default-marker-size="0"></circle></g></g></g><g id="SvgjsG1094" class="apexcharts-yaxis"><text id="SvgjsText1184" font-family="Helvetica, Arial, sans-serif" x="0" y="-122.0922619047619" text-anchor="middle" dominant-baseline="auto" font-size="11px" font-weight="regular" fill="#373d3f" class="apexcharts-text " style="font-family: Helvetica, Arial, sans-serif;">120</text><text id="SvgjsText1185" font-family="Helvetica, Arial, sans-serif" x="0" y="-90.06919642857142" text-anchor="middle" dominant-baseline="auto" font-size="11px" font-weight="regular" fill="#373d3f" class="apexcharts-text " style="font-family: Helvetica, Arial, sans-serif;">90</text><text id="SvgjsText1186" font-family="Helvetica, Arial, sans-serif" x="0" y="-58.04613095238095" text-anchor="middle" dominant-baseline="auto" font-size="11px" font-weight="regular" fill="#373d3f" class="apexcharts-text " style="font-family: Helvetica, Arial, sans-serif;">60</text><text id="SvgjsText1187" font-family="Helvetica, Arial, sans-serif" x="0" y="-26.023065476190474" text-anchor="middle" dominant-baseline="auto" font-size="11px" font-weight="regular" fill="#373d3f" class="apexcharts-text " style="font-family: Helvetica, Arial, sans-serif;">30</text><text id="SvgjsText1188" font-family="Helvetica, Arial, sans-serif" x="0" y="6" text-anchor="middle" dominant-baseline="auto" font-size="11px" font-weight="regular" fill="#373d3f" class="apexcharts-text " style="font-family: Helvetica, Arial, sans-serif;">0</text></g><g id="SvgjsG1097" class="apexcharts-datalabels" data:realIndex="0"></g><g id="SvgjsG1123" class="apexcharts-datalabels" data:realIndex="1"></g><g id="SvgjsG1149" class="apexcharts-datalabels" data:realIndex="2"></g></g><g id="SvgjsG1199" class="apexcharts-grid-borders" style="display: none;"></g><line id="SvgjsLine1207" x1="0" y1="0" x2="313.4140625" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1208" x1="0" y1="0" x2="313.4140625" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1209" class="apexcharts-yaxis-annotations apexcharts-hidden-element-shown"></g><g id="SvgjsG1210" class="apexcharts-xaxis-annotations apexcharts-hidden-element-shown"></g><g id="SvgjsG1211" class="apexcharts-point-annotations apexcharts-hidden-element-shown"></g></g></svg><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgba(37, 160, 226, 0.15);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 2;"><span class="apexcharts-tooltip-marker" style="background-color: rgba(37, 160, 226, 0.35);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 3;"><span class="apexcharts-tooltip-marker" style="background-color: rgba(37, 160, 226, 0.45);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xxl-6">
                <div class="card card-height-100">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Balance Overview</h4>
                        <div class="flex-shrink-0">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Current Year<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Today</a>
                                    <a class="dropdown-item" href="#">Last Week</a>
                                    <a class="dropdown-item" href="#">Last Month</a>
                                    <a class="dropdown-item" href="#">Current Year</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body px-0">
                        <ul class="list-inline main-chart text-center mb-0">
                            <li class="list-inline-item chart-border-left me-0 border-0">
                                <h4 class="text-primary">$584k <span class="text-muted d-inline-block fs-13 align-middle ms-2">Revenue</span></h4>
                            </li>
                            <li class="list-inline-item chart-border-left me-0">
                                <h4>$497k<span class="text-muted d-inline-block fs-13 align-middle ms-2">Expenses</span>
                                </h4>
                            </li>
                            <li class="list-inline-item chart-border-left me-0">
                                <h4><span data-plugin="counterup">3.6</span>%<span class="text-muted d-inline-block fs-13 align-middle ms-2">Profit Ratio</span></h4>
                            </li>
                        </ul>

                        <div id="revenue-expenses-charts" data-colors="[&quot;--vz-primary&quot;, &quot;--vz-info&quot;]" class="apex-charts" dir="ltr" style="min-height: 305px;"><div id="apexchartsjteueq1v" class="apexcharts-canvas apexchartsjteueq1v apexcharts-theme-light" style="width: 789px; height: 290px;"><svg id="SvgjsSvg1215" width="789" height="290" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg apexcharts-zoomable" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><foreignObject x="0" y="0" width="789" height="290"><div class="apexcharts-legend apexcharts-align-center apx-legend-position-bottom" xmlns="http://www.w3.org/1999/xhtml" style="inset: auto 0px 1px; position: absolute; max-height: 145px;"><div class="apexcharts-legend-series" rel="1" seriesname="Revenue" data:collapsed="false" style="margin: 2px 5px;"><span class="apexcharts-legend-marker" rel="1" data:collapsed="false" style="background: rgb(37, 160, 226) !important; color: rgb(37, 160, 226); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="1" i="0" data:default-text="Revenue" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Revenue</span></div><div class="apexcharts-legend-series" rel="2" seriesname="Expenses" data:collapsed="false" style="margin: 2px 5px;"><span class="apexcharts-legend-marker" rel="2" data:collapsed="false" style="background: rgb(50, 204, 255) !important; color: rgb(50, 204, 255); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="2" i="1" data:default-text="Expenses" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Expenses</span></div></div><style type="text/css">

                                            .apexcharts-legend {
                                                display: flex;
                                                overflow: auto;
                                                padding: 0 10px;
                                            }
                                            .apexcharts-legend.apx-legend-position-bottom, .apexcharts-legend.apx-legend-position-top {
                                                flex-wrap: wrap
                                            }
                                            .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
                                                flex-direction: column;
                                                bottom: 0;
                                            }
                                            .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left, .apexcharts-legend.apx-legend-position-top.apexcharts-align-left, .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {
                                                justify-content: flex-start;
                                            }
                                            .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center, .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
                                                justify-content: center;
                                            }
                                            .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right, .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
                                                justify-content: flex-end;
                                            }
                                            .apexcharts-legend-series {
                                                cursor: pointer;
                                                line-height: normal;
                                            }
                                            .apexcharts-legend.apx-legend-position-bottom .apexcharts-legend-series, .apexcharts-legend.apx-legend-position-top .apexcharts-legend-series{
                                                display: flex;
                                                align-items: center;
                                            }
                                            .apexcharts-legend-text {
                                                position: relative;
                                                font-size: 14px;
                                            }
                                            .apexcharts-legend-text *, .apexcharts-legend-marker * {
                                                pointer-events: none;
                                            }
                                            .apexcharts-legend-marker {
                                                position: relative;
                                                display: inline-block;
                                                cursor: pointer;
                                                margin-right: 3px;
                                                border-style: solid;
                                            }

                                            .apexcharts-legend.apexcharts-align-right .apexcharts-legend-series, .apexcharts-legend.apexcharts-align-left .apexcharts-legend-series{
                                                display: inline-block;
                                            }
                                            .apexcharts-legend-series.apexcharts-no-click {
                                                cursor: auto;
                                            }
                                            .apexcharts-legend .apexcharts-hidden-zero-series, .apexcharts-legend .apexcharts-hidden-null-series {
                                                display: none !important;
                                            }
                                            .apexcharts-inactive-legend {
                                                opacity: 0.45;
                                            }</style></foreignObject><rect id="SvgjsRect1220" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG1300" class="apexcharts-yaxis" rel="0" transform="translate(28.158203125, 0)"><g id="SvgjsG1301" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1303" font-family="Helvetica, Arial, sans-serif" x="20" y="31.5" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1304">$260k</tspan><title>$260k</title></text><text id="SvgjsText1306" font-family="Helvetica, Arial, sans-serif" x="20" y="70.5988" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1307">$208k</tspan><title>$208k</title></text><text id="SvgjsText1309" font-family="Helvetica, Arial, sans-serif" x="20" y="109.6976" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1310">$156k</tspan><title>$156k</title></text><text id="SvgjsText1312" font-family="Helvetica, Arial, sans-serif" x="20" y="148.7964" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1313">$104k</tspan><title>$104k</title></text><text id="SvgjsText1315" font-family="Helvetica, Arial, sans-serif" x="20" y="187.8952" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1316">$52k</tspan><title>$52k</title></text><text id="SvgjsText1318" font-family="Helvetica, Arial, sans-serif" x="20" y="226.99399999999997" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1319">$0k</tspan><title>$0k</title></text></g></g><g id="SvgjsG1217" class="apexcharts-inner apexcharts-graphical" transform="translate(58.158203125, 30)"><defs id="SvgjsDefs1216"><clipPath id="gridRectMaskjteueq1v"><rect id="SvgjsRect1222" width="715.119140625" height="197.494" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskjteueq1v"></clipPath><clipPath id="nonForecastMaskjteueq1v"></clipPath><clipPath id="gridRectMarkerMaskjteueq1v"><rect id="SvgjsRect1223" width="713.119140625" height="199.494" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><line id="SvgjsLine1221" x1="-0.5" y1="0" x2="-0.5" y2="195.494" stroke="#b6b6b6" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="-0.5" y="0" width="1" height="195.494" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><line id="SvgjsLine1239" x1="0" y1="196.494" x2="0" y2="202.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1240" x1="64.46537642045455" y1="196.494" x2="64.46537642045455" y2="202.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1241" x1="128.9307528409091" y1="196.494" x2="128.9307528409091" y2="202.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1242" x1="193.39612926136363" y1="196.494" x2="193.39612926136363" y2="202.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1243" x1="257.8615056818182" y1="196.494" x2="257.8615056818182" y2="202.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1244" x1="322.32688210227275" y1="196.494" x2="322.32688210227275" y2="202.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1245" x1="386.7922585227273" y1="196.494" x2="386.7922585227273" y2="202.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1246" x1="451.25763494318187" y1="196.494" x2="451.25763494318187" y2="202.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1247" x1="515.7230113636364" y1="196.494" x2="515.7230113636364" y2="202.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1248" x1="580.1883877840909" y1="196.494" x2="580.1883877840909" y2="202.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1249" x1="644.6537642045454" y1="196.494" x2="644.6537642045454" y2="202.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1250" x1="709.1191406249999" y1="196.494" x2="709.1191406249999" y2="202.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><g id="SvgjsG1235" class="apexcharts-grid"><g id="SvgjsG1236" class="apexcharts-gridlines-horizontal"><line id="SvgjsLine1252" x1="0" y1="39.0988" x2="709.119140625" y2="39.0988" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1253" x1="0" y1="78.1976" x2="709.119140625" y2="78.1976" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1254" x1="0" y1="117.29639999999999" x2="709.119140625" y2="117.29639999999999" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1255" x1="0" y1="156.3952" x2="709.119140625" y2="156.3952" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1256" x1="0" y1="195.49399999999997" x2="709.119140625" y2="195.49399999999997" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG1237" class="apexcharts-gridlines-vertical"></g><line id="SvgjsLine1258" x1="0" y1="195.494" x2="709.119140625" y2="195.494" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1257" x1="0" y1="1" x2="0" y2="195.494" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG1224" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1225" class="apexcharts-series" seriesName="Revenue" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1228" d="M0 195.494L0 180.456C22.56288174715909 180.456 41.90249467329546 176.69650000000001 64.46537642045455 176.69650000000001C87.02825816761364 176.69650000000001 106.36787109375001 172.937 128.9307528409091 172.937C151.49363458806818 172.937 170.83324751420454 169.1775 193.39612926136363 169.1775C215.95901100852274 169.1775 235.29862393465908 165.418 257.8615056818182 165.418C280.42438742897724 165.418 299.76400035511364 154.1395 322.3268821022727 154.1395C344.8897638494318 154.1395 364.22937677556814 142.861 386.79225852272725 142.861C409.35514026988636 142.861 428.6947531960227 112.785 451.2576349431818 112.785C473.8205166903409 112.785 493.16012961647726 82.709 515.7230113636364 82.709C538.2858931107954 82.709 557.6255060369318 60.15199999999999 580.1883877840909 60.15199999999999C602.7512695312499 60.15199999999999 622.0908824573863 37.595 644.6537642045454 37.595C667.2166459517045 37.595 686.5562588778408 7.5190000000000055 709.119140625 7.5190000000000055C709.119140625 7.5190000000000055 709.119140625 7.5190000000000055 709.119140625 195.494M709.119140625 7.5190000000000055C709.119140625 7.5190000000000055 709.119140625 7.5190000000000055 709.119140625 7.5190000000000055 " fill="rgba(37,160,226,0.06)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskjteueq1v)" pathTo="M 0 195.494 L 0 180.456C 22.56288174715909 180.456 41.90249467329546 176.69650000000001 64.46537642045455 176.69650000000001C 87.02825816761364 176.69650000000001 106.36787109375001 172.937 128.9307528409091 172.937C 151.49363458806818 172.937 170.83324751420454 169.1775 193.39612926136363 169.1775C 215.95901100852274 169.1775 235.29862393465908 165.418 257.8615056818182 165.418C 280.42438742897724 165.418 299.76400035511364 154.1395 322.3268821022727 154.1395C 344.8897638494318 154.1395 364.22937677556814 142.861 386.79225852272725 142.861C 409.35514026988636 142.861 428.6947531960227 112.785 451.2576349431818 112.785C 473.8205166903409 112.785 493.16012961647726 82.709 515.7230113636364 82.709C 538.2858931107954 82.709 557.6255060369318 60.15199999999999 580.1883877840909 60.15199999999999C 602.7512695312499 60.15199999999999 622.0908824573863 37.595 644.6537642045454 37.595C 667.2166459517045 37.595 686.5562588778408 7.5190000000000055 709.119140625 7.5190000000000055C 709.119140625 7.5190000000000055 709.119140625 7.5190000000000055 709.119140625 195.494M 709.119140625 7.5190000000000055z" pathFrom="M -1 195.494 L -1 195.494 L 64.46537642045455 195.494 L 128.9307528409091 195.494 L 193.39612926136363 195.494 L 257.8615056818182 195.494 L 322.3268821022727 195.494 L 386.79225852272725 195.494 L 451.2576349431818 195.494 L 515.7230113636364 195.494 L 580.1883877840909 195.494 L 644.6537642045454 195.494 L 709.119140625 195.494"></path><path id="SvgjsPath1229" d="M0 180.456C22.56288174715909 180.456 41.90249467329546 176.69650000000001 64.46537642045455 176.69650000000001C87.02825816761364 176.69650000000001 106.36787109375001 172.937 128.9307528409091 172.937C151.49363458806818 172.937 170.83324751420454 169.1775 193.39612926136363 169.1775C215.95901100852274 169.1775 235.29862393465908 165.418 257.8615056818182 165.418C280.42438742897724 165.418 299.76400035511364 154.1395 322.3268821022727 154.1395C344.8897638494318 154.1395 364.22937677556814 142.861 386.79225852272725 142.861C409.35514026988636 142.861 428.6947531960227 112.785 451.2576349431818 112.785C473.8205166903409 112.785 493.16012961647726 82.709 515.7230113636364 82.709C538.2858931107954 82.709 557.6255060369318 60.15199999999999 580.1883877840909 60.15199999999999C602.7512695312499 60.15199999999999 622.0908824573863 37.595 644.6537642045454 37.595C667.2166459517045 37.595 686.5562588778408 7.5190000000000055 709.119140625 7.5190000000000055C709.119140625 7.5190000000000055 709.119140625 7.5190000000000055 709.119140625 7.5190000000000055 " fill="none" fill-opacity="1" stroke="#25a0e2" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskjteueq1v)" pathTo="M 0 180.456C 22.56288174715909 180.456 41.90249467329546 176.69650000000001 64.46537642045455 176.69650000000001C 87.02825816761364 176.69650000000001 106.36787109375001 172.937 128.9307528409091 172.937C 151.49363458806818 172.937 170.83324751420454 169.1775 193.39612926136363 169.1775C 215.95901100852274 169.1775 235.29862393465908 165.418 257.8615056818182 165.418C 280.42438742897724 165.418 299.76400035511364 154.1395 322.3268821022727 154.1395C 344.8897638494318 154.1395 364.22937677556814 142.861 386.79225852272725 142.861C 409.35514026988636 142.861 428.6947531960227 112.785 451.2576349431818 112.785C 473.8205166903409 112.785 493.16012961647726 82.709 515.7230113636364 82.709C 538.2858931107954 82.709 557.6255060369318 60.15199999999999 580.1883877840909 60.15199999999999C 602.7512695312499 60.15199999999999 622.0908824573863 37.595 644.6537642045454 37.595C 667.2166459517045 37.595 686.5562588778408 7.5190000000000055 709.119140625 7.5190000000000055" pathFrom="M -1 195.494 L -1 195.494 L 64.46537642045455 195.494 L 128.9307528409091 195.494 L 193.39612926136363 195.494 L 257.8615056818182 195.494 L 322.3268821022727 195.494 L 386.79225852272725 195.494 L 451.2576349431818 195.494 L 515.7230113636364 195.494 L 580.1883877840909 195.494 L 644.6537642045454 195.494 L 709.119140625 195.494" fill-rule="evenodd"></path><g id="SvgjsG1226" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1323" r="0" cx="0" cy="180.456" class="apexcharts-marker w3o42in1x no-pointer-events" stroke="#ffffff" fill="#25a0e2" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG1230" class="apexcharts-series" seriesName="Expenses" data:longestSeries="true" rel="2" data:realIndex="1"><path id="SvgjsPath1233" d="M0 195.494L0 186.4712C22.56288174715909 186.4712 41.90249467329546 182.7117 64.46537642045455 182.7117C87.02825816761364 182.7117 106.36787109375001 161.6585 128.9307528409091 161.6585C151.49363458806818 161.6585 170.83324751420454 163.9142 193.39612926136363 163.9142C215.95901100852274 163.9142 235.29862393465908 177.4484 257.8615056818182 177.4484C280.42438742897724 177.4484 299.76400035511364 169.1775 322.3268821022727 169.1775C344.8897638494318 169.1775 364.22937677556814 163.9142 386.79225852272725 163.9142C409.35514026988636 163.9142 428.6947531960227 139.1015 451.2576349431818 139.1015C473.8205166903409 139.1015 493.16012961647726 118.8002 515.7230113636364 118.8002C538.2858931107954 118.8002 557.6255060369318 114.2888 580.1883877840909 114.2888C602.7512695312499 114.2888 622.0908824573863 78.1976 644.6537642045454 78.1976C667.2166459517045 78.1976 686.5562588778408 45.86590000000001 709.119140625 45.86590000000001C709.119140625 45.86590000000001 709.119140625 45.86590000000001 709.119140625 195.494M709.119140625 45.86590000000001C709.119140625 45.86590000000001 709.119140625 45.86590000000001 709.119140625 45.86590000000001 " fill="rgba(50,204,255,0.06)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="1" clip-path="url(#gridRectMaskjteueq1v)" pathTo="M 0 195.494 L 0 186.4712C 22.56288174715909 186.4712 41.90249467329546 182.7117 64.46537642045455 182.7117C 87.02825816761364 182.7117 106.36787109375001 161.6585 128.9307528409091 161.6585C 151.49363458806818 161.6585 170.83324751420454 163.9142 193.39612926136363 163.9142C 215.95901100852274 163.9142 235.29862393465908 177.4484 257.8615056818182 177.4484C 280.42438742897724 177.4484 299.76400035511364 169.1775 322.3268821022727 169.1775C 344.8897638494318 169.1775 364.22937677556814 163.9142 386.79225852272725 163.9142C 409.35514026988636 163.9142 428.6947531960227 139.1015 451.2576349431818 139.1015C 473.8205166903409 139.1015 493.16012961647726 118.8002 515.7230113636364 118.8002C 538.2858931107954 118.8002 557.6255060369318 114.2888 580.1883877840909 114.2888C 602.7512695312499 114.2888 622.0908824573863 78.1976 644.6537642045454 78.1976C 667.2166459517045 78.1976 686.5562588778408 45.86590000000001 709.119140625 45.86590000000001C 709.119140625 45.86590000000001 709.119140625 45.86590000000001 709.119140625 195.494M 709.119140625 45.86590000000001z" pathFrom="M -1 195.494 L -1 195.494 L 64.46537642045455 195.494 L 128.9307528409091 195.494 L 193.39612926136363 195.494 L 257.8615056818182 195.494 L 322.3268821022727 195.494 L 386.79225852272725 195.494 L 451.2576349431818 195.494 L 515.7230113636364 195.494 L 580.1883877840909 195.494 L 644.6537642045454 195.494 L 709.119140625 195.494"></path><path id="SvgjsPath1234" d="M0 186.4712C22.56288174715909 186.4712 41.90249467329546 182.7117 64.46537642045455 182.7117C87.02825816761364 182.7117 106.36787109375001 161.6585 128.9307528409091 161.6585C151.49363458806818 161.6585 170.83324751420454 163.9142 193.39612926136363 163.9142C215.95901100852274 163.9142 235.29862393465908 177.4484 257.8615056818182 177.4484C280.42438742897724 177.4484 299.76400035511364 169.1775 322.3268821022727 169.1775C344.8897638494318 169.1775 364.22937677556814 163.9142 386.79225852272725 163.9142C409.35514026988636 163.9142 428.6947531960227 139.1015 451.2576349431818 139.1015C473.8205166903409 139.1015 493.16012961647726 118.8002 515.7230113636364 118.8002C538.2858931107954 118.8002 557.6255060369318 114.2888 580.1883877840909 114.2888C602.7512695312499 114.2888 622.0908824573863 78.1976 644.6537642045454 78.1976C667.2166459517045 78.1976 686.5562588778408 45.86590000000001 709.119140625 45.86590000000001C709.119140625 45.86590000000001 709.119140625 45.86590000000001 709.119140625 45.86590000000001 " fill="none" fill-opacity="1" stroke="#32ccff" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="1" clip-path="url(#gridRectMaskjteueq1v)" pathTo="M 0 186.4712C 22.56288174715909 186.4712 41.90249467329546 182.7117 64.46537642045455 182.7117C 87.02825816761364 182.7117 106.36787109375001 161.6585 128.9307528409091 161.6585C 151.49363458806818 161.6585 170.83324751420454 163.9142 193.39612926136363 163.9142C 215.95901100852274 163.9142 235.29862393465908 177.4484 257.8615056818182 177.4484C 280.42438742897724 177.4484 299.76400035511364 169.1775 322.3268821022727 169.1775C 344.8897638494318 169.1775 364.22937677556814 163.9142 386.79225852272725 163.9142C 409.35514026988636 163.9142 428.6947531960227 139.1015 451.2576349431818 139.1015C 473.8205166903409 139.1015 493.16012961647726 118.8002 515.7230113636364 118.8002C 538.2858931107954 118.8002 557.6255060369318 114.2888 580.1883877840909 114.2888C 602.7512695312499 114.2888 622.0908824573863 78.1976 644.6537642045454 78.1976C 667.2166459517045 78.1976 686.5562588778408 45.86590000000001 709.119140625 45.86590000000001" pathFrom="M -1 195.494 L -1 195.494 L 64.46537642045455 195.494 L 128.9307528409091 195.494 L 193.39612926136363 195.494 L 257.8615056818182 195.494 L 322.3268821022727 195.494 L 386.79225852272725 195.494 L 451.2576349431818 195.494 L 515.7230113636364 195.494 L 580.1883877840909 195.494 L 644.6537642045454 195.494 L 709.119140625 195.494" fill-rule="evenodd"></path><g id="SvgjsG1231" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown" data:realIndex="1"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1324" r="0" cx="0" cy="186.4712" class="apexcharts-marker w3c1jhvry no-pointer-events" stroke="#ffffff" fill="#32ccff" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG1227" class="apexcharts-datalabels" data:realIndex="0"></g><g id="SvgjsG1232" class="apexcharts-datalabels" data:realIndex="1"></g></g><g id="SvgjsG1238" class="apexcharts-grid-borders"><line id="SvgjsLine1251" x1="0" y1="0" x2="709.119140625" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1299" x1="0" y1="196.494" x2="709.119140625" y2="196.494" stroke="#e0e0e0" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"></line></g><line id="SvgjsLine1259" x1="0" y1="0" x2="709.119140625" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1260" x1="0" y1="0" x2="709.119140625" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1261" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1262" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1264" font-family="Helvetica, Arial, sans-serif" x="0" y="224.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1265">Jan</tspan><title>Jan</title></text><text id="SvgjsText1267" font-family="Helvetica, Arial, sans-serif" x="64.46537642045453" y="224.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1268">Feb</tspan><title>Feb</title></text><text id="SvgjsText1270" font-family="Helvetica, Arial, sans-serif" x="128.9307528409091" y="224.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1271">Mar</tspan><title>Mar</title></text><text id="SvgjsText1273" font-family="Helvetica, Arial, sans-serif" x="193.39612926136365" y="224.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1274">Apr</tspan><title>Apr</title></text><text id="SvgjsText1276" font-family="Helvetica, Arial, sans-serif" x="257.86150568181824" y="224.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1277">May</tspan><title>May</title></text><text id="SvgjsText1279" font-family="Helvetica, Arial, sans-serif" x="322.3268821022728" y="224.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1280">Jun</tspan><title>Jun</title></text><text id="SvgjsText1282" font-family="Helvetica, Arial, sans-serif" x="386.79225852272737" y="224.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1283">Jul</tspan><title>Jul</title></text><text id="SvgjsText1285" font-family="Helvetica, Arial, sans-serif" x="451.2576349431819" y="224.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1286">Aug</tspan><title>Aug</title></text><text id="SvgjsText1288" font-family="Helvetica, Arial, sans-serif" x="515.7230113636365" y="224.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1289">Sep</tspan><title>Sep</title></text><text id="SvgjsText1291" font-family="Helvetica, Arial, sans-serif" x="580.188387784091" y="224.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1292">Oct</tspan><title>Oct</title></text><text id="SvgjsText1294" font-family="Helvetica, Arial, sans-serif" x="644.6537642045455" y="224.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1295">Nov</tspan><title>Nov</title></text><text id="SvgjsText1297" font-family="Helvetica, Arial, sans-serif" x="709.119140625" y="224.494" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1298">Dec</tspan><title>Dec</title></text></g></g><g id="SvgjsG1320" class="apexcharts-yaxis-annotations apexcharts-hidden-element-shown"></g><g id="SvgjsG1321" class="apexcharts-xaxis-annotations apexcharts-hidden-element-shown"></g><g id="SvgjsG1322" class="apexcharts-point-annotations apexcharts-hidden-element-shown"></g><rect id="SvgjsRect1325" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-zoom-rect"></rect><rect id="SvgjsRect1326" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-selection-rect"></rect></g></svg><div class="apexcharts-tooltip apexcharts-theme-light" style="left: 69.1582px; top: 122.494px;"><div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">Jan</div><div class="apexcharts-tooltip-series-group apexcharts-active" style="order: 1; display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(37, 160, 226);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label">Revenue: </span><span class="apexcharts-tooltip-text-y-value">$20k</span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group apexcharts-active" style="order: 2; display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(50, 204, 255);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label">Expenses: </span><span class="apexcharts-tooltip-text-y-value">$12k</span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light" style="left: 37.4785px; top: 227.494px;"><div class="apexcharts-xaxistooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; min-width: 18.0664px;">Jan</div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                    </div>
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-xl-7">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Deals Status</h4>
                        <div class="flex-shrink-0">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted">02 Nov 2021 to 31 Dec 2021<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Today</a>
                                    <a class="dropdown-item" href="#">Last Week</a>
                                    <a class="dropdown-item" href="#">Last Month</a>
                                    <a class="dropdown-item" href="#">Current Year</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                                <thead class="table-light">
                                <tr class="text-muted">
                                    <th scope="col">Name</th>
                                    <th scope="col" style="width: 20%;">Last Contacted</th>
                                    <th scope="col">Sales Representative</th>
                                    <th scope="col" style="width: 16%;">Status</th>
                                    <th scope="col" style="width: 12%;">Deal Value</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td>Absternet LLC</td>
                                    <td>Sep 20, 2021</td>
                                    <td><img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-xs rounded-circle me-2">
                                        <a href="#javascript: void(0);" class="text-body fw-medium">Donald Risher</a>
                                    </td>
                                    <td><span class="badge bg-success-subtle text-success p-2">Deal Won</span></td>
                                    <td>
                                        <div class="text-nowrap">$100.1K</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Raitech Soft</td>
                                    <td>Sep 23, 2021</td>
                                    <td><img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-xs rounded-circle me-2">
                                        <a href="#javascript: void(0);" class="text-body fw-medium">Sofia Cunha</a>
                                    </td>
                                    <td><span class="badge bg-warning-subtle text-warning p-2">Intro Call</span></td>
                                    <td>
                                        <div class="text-nowrap">$150K</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>William PVT</td>
                                    <td>Sep 27, 2021</td>
                                    <td><img src="assets/images/users/avatar-3.jpg" alt="" class="avatar-xs rounded-circle me-2">
                                        <a href="#javascript: void(0);" class="text-body fw-medium">Luis Rocha</a>
                                    </td>
                                    <td><span class="badge bg-danger-subtle text-danger p-2">Stuck</span></td>
                                    <td>
                                        <div class="text-nowrap">$78.18K</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Loiusee LLP</td>
                                    <td>Sep 30, 2021</td>
                                    <td><img src="assets/images/users/avatar-4.jpg" alt="" class="avatar-xs rounded-circle me-2">
                                        <a href="#javascript: void(0);" class="text-body fw-medium">Vitoria Rodrigues</a>
                                    </td>
                                    <td><span class="badge bg-success-subtle text-success p-2">Deal Won</span></td>
                                    <td>
                                        <div class="text-nowrap">$180K</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Apple Inc.</td>
                                    <td>Sep 30, 2021</td>
                                    <td><img src="assets/images/users/avatar-6.jpg" alt="" class="avatar-xs rounded-circle me-2">
                                        <a href="#javascript: void(0);" class="text-body fw-medium">Vitoria Rodrigues</a>
                                    </td>
                                    <td><span class="badge bg-primary-subtle text-primary p-2">New Lead</span></td>
                                    <td>
                                        <div class="text-nowrap">$78.9K</div>
                                    </td>
                                </tr>
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div><!-- end table responsive -->
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-5">
                <div class="card card-height-100">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">My Tasks</h4>
                        <div class="flex-shrink-0">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted"><i class="ri-settings-4-line align-middle me-1 fs-15"></i>Settings</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="#">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body p-0">

                        <div class="align-items-center p-3 justify-content-between d-flex">
                            <div class="flex-shrink-0">
                                <div class="text-muted"><span class="fw-semibold">4</span> of <span class="fw-semibold">10</span> remaining</div>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary"><i class="ri-add-line align-middle me-1"></i> Add Task</button>
                        </div><!-- end card header -->

                        <div data-simplebar="init" style="max-height: 219px;" class="simplebar-scrollable-y"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
                                                <ul class="list-group list-group-flush border-dashed px-3">
                                                    <li class="list-group-item ps-0">
                                                        <div class="d-flex align-items-start">
                                                            <div class="form-check ps-0 flex-sharink-0">
                                                                <input type="checkbox" class="form-check-input ms-0" id="task_one">
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <label class="form-check-label mb-0 ps-2" for="task_one">Review and make sure nothing slips through cracks</label>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-2">
                                                                <p class="text-muted fs-12 mb-0">15 Sep, 2021</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item ps-0">
                                                        <div class="d-flex align-items-start">
                                                            <div class="form-check ps-0 flex-sharink-0">
                                                                <input type="checkbox" class="form-check-input ms-0" id="task_two">
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <label class="form-check-label mb-0 ps-2" for="task_two">Send meeting invites for sales upcampaign</label>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-2">
                                                                <p class="text-muted fs-12 mb-0">20 Sep, 2021</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item ps-0">
                                                        <div class="d-flex align-items-start">
                                                            <div class="form-check flex-sharink-0 ps-0">
                                                                <input type="checkbox" class="form-check-input ms-0" id="task_three">
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <label class="form-check-label mb-0 ps-2" for="task_three">Weekly closed sales won checking with sales team</label>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-2">
                                                                <p class="text-muted fs-12 mb-0">24 Sep, 2021</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item ps-0">
                                                        <div class="d-flex align-items-start">
                                                            <div class="form-check ps-0 flex-sharink-0">
                                                                <input type="checkbox" class="form-check-input ms-0" id="task_four">
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <label class="form-check-label mb-0 ps-2" for="task_four">Add notes that can be viewed from the individual view</label>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-2">
                                                                <p class="text-muted fs-12 mb-0">27 Sep, 2021</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item ps-0">
                                                        <div class="d-flex align-items-start">
                                                            <div class="form-check ps-0 flex-sharink-0">
                                                                <input type="checkbox" class="form-check-input ms-0" id="task_five">
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <label class="form-check-label mb-0 ps-2" for="task_five">Move stuff to another page</label>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-2">
                                                                <p class="text-muted fs-12 mb-0">27 Sep, 2021</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item ps-0">
                                                        <div class="d-flex align-items-start">
                                                            <div class="form-check ps-0 flex-sharink-0">
                                                                <input type="checkbox" class="form-check-input ms-0" id="task_six">
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <label class="form-check-label mb-0 ps-2" for="task_six">Styling wireframe design and documentation for velzon admin</label>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-2">
                                                                <p class="text-muted fs-12 mb-0">27 Sep, 2021</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul><!-- end ul -->
                                            </div></div></div></div><div class="simplebar-placeholder" style="width: 653px; height: 277px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 173px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>
                        <div class="p-3 pt-2">
                            <a href="javascript:void(0);" class="text-muted text-decoration-underline">Show more...</a>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-xxl-5">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Upcoming Activities</h4>
                        <div class="flex-shrink-0">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted fs-18"><i class="mdi mdi-dots-vertical"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="#">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body pt-0">
                        <ul class="list-group list-group-flush border-dashed">
                            <li class="list-group-item ps-0">
                                <div class="row align-items-center g-3">
                                    <div class="col-auto">
                                        <div class="avatar-sm p-1 py-2 h-auto bg-light rounded-3">
                                            <div class="text-center">
                                                <h5 class="mb-0">25</h5>
                                                <div class="text-muted">Tue</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5 class="text-muted mt-0 mb-1 fs-13">12:00am - 03:30pm</h5>
                                        <a href="#" class="text-reset fs-14 mb-0">Meeting for campaign with sales team</a>
                                    </div>
                                    <div class="col-sm-auto">
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Stine Nielsen">
                                                    <img src="assets/images/users/avatar-1.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Jansh Brown">
                                                    <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Dan Gibson">
                                                    <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);">
                                                    <div class="avatar-xxs">
                                                                    <span class="avatar-title rounded-circle bg-primary text-white">
                                                                        5
                                                                    </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </li><!-- end -->
                            <li class="list-group-item ps-0">
                                <div class="row align-items-center g-3">
                                    <div class="col-auto">
                                        <div class="avatar-sm p-1 py-2 h-auto bg-light rounded-3">
                                            <div class="text-center">
                                                <h5 class="mb-0">20</h5>
                                                <div class="text-muted">Wed</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5 class="text-muted mt-0 mb-1 fs-13">02:00pm - 03:45pm</h5>
                                        <a href="#" class="text-reset fs-14 mb-0">Adding a new event with attachments</a>
                                    </div>
                                    <div class="col-sm-auto">
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Frida Bang">
                                                    <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Malou Silva">
                                                    <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Simon Schmidt">
                                                    <img src="assets/images/users/avatar-6.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Tosh Jessen">
                                                    <img src="assets/images/users/avatar-7.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);">
                                                    <div class="avatar-xxs">
                                                                    <span class="avatar-title rounded-circle bg-success text-white">
                                                                        3
                                                                    </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </li><!-- end -->
                            <li class="list-group-item ps-0">
                                <div class="row align-items-center g-3">
                                    <div class="col-auto">
                                        <div class="avatar-sm p-1 py-2 h-auto bg-light rounded-3">
                                            <div class="text-center">
                                                <h5 class="mb-0">17</h5>
                                                <div class="text-muted">Wed</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5 class="text-muted mt-0 mb-1 fs-13">04:30pm - 07:15pm</h5>
                                        <a href="#" class="text-reset fs-14 mb-0">Create new project Bundling Product</a>
                                    </div>
                                    <div class="col-sm-auto">
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Nina Schmidt">
                                                    <img src="assets/images/users/avatar-8.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Stine Nielsen">
                                                    <img src="assets/images/users/avatar-1.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Jansh Brown">
                                                    <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);">
                                                    <div class="avatar-xxs">
                                                                    <span class="avatar-title rounded-circle bg-primary text-white">
                                                                        4
                                                                    </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </li><!-- end -->
                            <li class="list-group-item ps-0">
                                <div class="row align-items-center g-3">
                                    <div class="col-auto">
                                        <div class="avatar-sm p-1 py-2 h-auto bg-light rounded-3">
                                            <div class="text-center">
                                                <h5 class="mb-0">12</h5>
                                                <div class="text-muted">Tue</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5 class="text-muted mt-0 mb-1 fs-13">10:30am - 01:15pm</h5>
                                        <a href="#" class="text-reset fs-14 mb-0">Weekly closed sales won checking with sales team</a>
                                    </div>
                                    <div class="col-sm-auto">
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Stine Nielsen">
                                                    <img src="assets/images/users/avatar-1.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Jansh Brown">
                                                    <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Dan Gibson">
                                                    <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);">
                                                    <div class="avatar-xxs">
                                                                    <span class="avatar-title rounded-circle bg-warning text-white">
                                                                        9
                                                                    </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </li><!-- end -->
                        </ul><!-- end -->
                        <div class="align-items-center mt-2 row g-3 text-center text-sm-start">
                            <div class="col-sm">
                                <div class="text-muted">Showing<span class="fw-semibold">4</span> of <span class="fw-semibold">125</span> Results
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <ul class="pagination pagination-separated pagination-sm justify-content-center justify-content-sm-start mb-0">
                                    <li class="page-item disabled">
                                        <a href="#" class="page-link">←</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">1</a>
                                    </li>
                                    <li class="page-item active">
                                        <a href="#" class="page-link">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">→</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xxl-7">
                <div class="card card-height-100">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Closing Deals</h4>
                        <div class="flex-shrink-0">
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                <option selected="">Closed Deals</option>
                                <option value="1">Active Deals</option>
                                <option value="2">Paused Deals</option>
                                <option value="3">Canceled Deals</option>
                            </select>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-nowrap align-middle mb-0">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 30%;">Deal Name</th>
                                    <th scope="col" style="width: 30%;">Sales Rep</th>
                                    <th scope="col" style="width: 20%;">Amount</th>
                                    <th scope="col" style="width: 20%;">Close Date</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td>Acme Inc Install</td>
                                    <td><img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-xs rounded-circle me-2">
                                        <a href="#javascript: void(0);" class="text-body fw-medium">Donald Risher</a>
                                    </td>
                                    <td>$96k</td>
                                    <td>Today</td>
                                </tr>
                                <tr>
                                    <td>Save lots Stores</td>
                                    <td><img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-xs rounded-circle me-2">
                                        <a href="#javascript: void(0);" class="text-body fw-medium">Jansh Brown</a>
                                    </td>
                                    <td>$55.7k</td>
                                    <td>30 Dec 2021</td>
                                </tr>
                                <tr>
                                    <td>William PVT</td>
                                    <td><img src="assets/images/users/avatar-7.jpg" alt="" class="avatar-xs rounded-circle me-2">
                                        <a href="#javascript: void(0);" class="text-body fw-medium">Ayaan Hudda</a>
                                    </td>
                                    <td>$102k</td>
                                    <td>25 Nov 2021</td>
                                </tr>
                                <tr>
                                    <td>Raitech Soft</td>
                                    <td><img src="assets/images/users/avatar-4.jpg" alt="" class="avatar-xs rounded-circle me-2">
                                        <a href="#javascript: void(0);" class="text-body fw-medium">Julia William</a>
                                    </td>
                                    <td>$89.5k</td>
                                    <td>20 Sep 2021</td>
                                </tr>
                                <tr>
                                    <td>Absternet LLC</td>
                                    <td><img src="assets/images/users/avatar-4.jpg" alt="" class="avatar-xs rounded-circle me-2">
                                        <a href="#javascript: void(0);" class="text-body fw-medium">Vitoria Rodrigues</a>
                                    </td>
                                    <td>$89.5k</td>
                                    <td>20 Sep 2021</td>
                                </tr>
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div><!-- end table responsive -->
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->
@endsection
