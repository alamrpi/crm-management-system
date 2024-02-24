
<!-- Modal -->
<div class="modal custom-modal" id="fileViewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-3">
                <p class="modal-title fs-16" id="fileViewModalTitle">Modal title</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="row">
                   <div class="col-md-12 text-center">
                       <iframe id="fileViewModalPdfViewer" frameborder="0" style="display: none; width: 100%; height: 80vh;"></iframe>

                       <div style="width: 100%;  height: 50%">
                           <img src="" alt="" id="fileViewModalImageViewer" style="height: 100%;">
                       </div>

                       <a href="" class="btn bg-success-subtle px-lg-5 py-3" id="downloadOtherFile">
                           <span class="fs-3">The file cannot be viewed directly</span>
                           <br>
                           <span class="btn btn-success mt-4">Download Now</span>
                       </a>

                   </div>
               </div>
            </div>
        </div>
    </div>
</div>
