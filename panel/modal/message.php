<!-- Existing modals -->

<div id="messageModal" class="modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="messageText">Your message will be displayed here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>

#messageModal {
  display: none; 
  position: fixed;
  z-index: 4; 
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  outline: 0;
}

#messageModal .modal-dialog {
  max-width: 80% !important;
}

#messageModal .modal-content {
  display: flex;
  flex-direction: column;
}

#messageModal .modal-header {
  padding: 1rem;
}

#messageModal .modal-header .close {
  margin: 0;
}

#messageModal .modal-body {
  flex: 1;
  padding: 1rem;
}

#messageModal .modal-footer {
  padding: 1rem;
  display: flex;
  justify-content: flex-end;
}
</style>
