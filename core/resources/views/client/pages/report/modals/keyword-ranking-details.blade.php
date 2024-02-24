
<!-- Modal -->
<div class="modal custom-modal" id="keywordDetailsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-3 bg-light-subtle">
                <h1 class="modal-title fs-5" id="kewordTitle">SEO Expert - Details</h1>
                <button type="button" class="btn-close" onclick="closeRankingDetailsModal()"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-sm fs-14">
                                            <thead>
                                            <tr>
                                                <th class="bg-primary text-light">Keyword</th>
                                                <th  class="bg-primary text-light">SV</th>
                                                <th  class="bg-primary text-light">KD</th>
                                                <th  class="bg-primary text-light">CPC</th>
                                                <th  class="bg-primary text-light">CR</th>
                                                <th  class="bg-primary text-light">Country</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Keyword 01</td>
                                                <td>350</td>
                                                <td>Hard</td>
                                                <td>7.2</td>
                                                <td>3</td>
                                                <td>USA</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <canvas id="keywordRankingPositionChart" class="chartjs-chart" data-colors='["--vz-primary-rgb, 0.2", "--vz-primary", "--vz-info-rgb, 0.2", "--vz-info"]'></canvas>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Related Keywords</h5>
                                        <table class="table table-bordered table-sm fs-14">
                                            <thead>
                                            <tr>
                                                <th>Keyword</th>
                                                <th>Position</th>
                                            </tr>
                                            </thead>
                                            <tbody id="related-keyword-placeholder">
                                          
                                           
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
