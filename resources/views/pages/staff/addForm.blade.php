<div class="space50">&nbsp;</div>
<div class="container beta-relative">
    <div class="pull-left">
        <h2>Add staff</h2>
    </div>
    <div class="space50">&nbsp;</div>
    @include('error')
    <div class="container">
        <form action="addForm" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for='inputName'>Name</label>
                <input type="text" class="form-control" name="inputName" id="inputName" placeholder="Enter name" required>
            </div>

            <div class="form-group">
                <label for='inputImage'>Image</label>
                <input type="file" class="form-control-file" name="inputImage" id="inputImage" required>
            </div>

            <div class="form-group">
                <select for='inputGender'>Gender</label>
                <option  value="Nam" class="form-control" name="inputGender" id="inputGender">Nam</option>
                <option  value="Nu" class="form-control" name="inputGender" id="inputGender">Nữ</option>
                <option  value="Khac" class="form-control" name="inputGender" id="inputGender">Khác</option>
            </div>

            <div class="form-group">
                <label for='inputPosition'>Position</label>
                <input type="text" class="form-control" name="inputPosition" id="inputPosition" placeholder="Enter pos" required>
            </div>
            

            <div class="form-group">
                <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" alt="preview image" style="max-height: 250px;">
                <script type="text/javascript">
                    $(document).ready(function(e) {
                        $('#inputImage').change(function() {
                            let reader = new FileReader();
                            reader.onload = (e) => {
                                $('#preview-image-before-upload').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(this.files[0]);
                        });
                    });
                </script>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="space50">&nbsp;</div>
</div>