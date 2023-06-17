<div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Creating Ticket</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0);" onsubmit="create_ticket();">
                <div class="modal-body">
                    <label>Subject: </label>
                    <div class="form-group">
                        <input name="title" type="text" placeholder="" class="form-control" />
                    </div>
    
                    <label>Message: </label>
                    <div class="form-group">
                        <textarea name="content" class="form-control" rows="3" placeholder="" spellcheck="false"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="create_ticket();">Submit</button>
                </div>
            </form>
        </div> 
    </div>
</div>
 
<footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2023 | <span class="d-none d-sm-inline-block"> All rights Reserved</span></span><span class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
</footer>

<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>