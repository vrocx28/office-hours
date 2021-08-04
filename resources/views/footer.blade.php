<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

<script>
    // function to generte random password
    function randompass() {
        var length = 8,
            charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
            retVal = "";
        for (var i = 0, n = charset.length; i < length; ++i) {
            retVal += charset.charAt(Math.floor(Math.random() * n));
        }
        document.getElementById("inputPassword").value = retVal;
    }
    // function to validate form
    $(document).ready(function() {
        $('#AddEmp').validate({
            rules: {
                inputFname: 'required',
                inputLname: 'required',
                inputDesignation: 'required',
                inputEmployeeID: 'required',
                inputJDate: 'required',
                inputDepartment: 'required',
                inputStatus: 'required',
                inputGradCollege: 'required',
                inputGradDegree: 'required',
                inputGradPassYear: 'required',
                inputGradState: 'required',
                inputGradCity: 'required',
                inputPerEmail: {
                    required: true,
                    email: true,
                },
                inputComEmail: {
                    required: true,
                    email: true,
                },
                inputPassword: {
                    required: true,
                    minlength: 8,
                }
            },
            messages: {
                inputFname: 'This field is required',
                inputLname: 'This field is required',
                inputDesignation: 'This field is required',
                inputEmployeeID: 'This field is required',
                inputJDate: 'This field is required',
                inputDepartment: 'This field is required',
                inputStatus: 'This field is required',
                inputPerEmail: 'Enter a valid email',
                inputComEmail: 'Enter a valid email',
                inputGradCollege: 'This field is required',
                inputGradDegree: 'This field is required',
                inputGradPassYear: 'Select Year',
                inputGradState: 'This field is required',
                inputGradCity: 'This field is required',
                inputPassword: {
                    minlength: 'Password must be at least 8 characters long'
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });

    // function to append dynamic feilds
    // function addMore(obj) {
    //     $(obj).html('-');
    //     $(obj).attr("onclick", "remove(this)")
    //     var length = $('.after-add-more').length;
    //     $('.after-add-more').append('<div class="row first_element"><div class="col-md-4"><label for="inputDegreetype" class="form-label">Degree Type</label><select id="inputDegreetype' + length + '" name="inputDegreetype[]" class="form-select unique-value" onchange="displayCourse(' + length + ')"><option selected value="">Choose...</option><option value="Graduation">Graduation</option><option value="Masters">Masters</option></select></div><div class="col-md-4"><label for="inputDegreeName" class="form-label">Select Degree</label><select id="course' + length + '" name="inputDegree[]" class="form-select" style="display:none"><option selected value="">Choose...</option><option value="Graduation">B.tech</option><option value="Masters">BCA</option></select></div><div class="col-md-4"><label for="inputPassYear" class="form-label">Passing year</label><select name="inputPassYear[]" class="form-select passyear"><option>Select...</option>{{ $year = date("Y")}}@for ($i = 1990; $i <= $year; $i++)<option value="{{$i}}">{{$i}}</option>@endfor</select></div><div class="col-md-5"><label for="inputCollege" class="form-label">College Name</label><input type="text" class="form-control" id="inputCollege" name="inputCollege[]"></div><div class="col-md-3"> <label for="inputState" class="form-label">State</label><select id="inputState' + length + '" name="inputState[]" class="form-select" data-live-search="true" onchange="getCityLIstFromStateId(this)"><option value="">Select</option>@if(!empty($states) && count($states) > 0)@foreach($states as $state)<option value="{{$state->id}}">{{$state->state}}</option> @endforeach @endif </select></div><div class="col-md-3"><label for="inputCity" class="form-label">City</label><select name="inputCity[]" class="form-select city" data-live-search="true"><option value="">Select</option></select></div><div class="col-md-1"><label for="addMore" class="form-label"></label><button type="button" class="btn btn-primary add-mr" onclick="remove(this);">-</button></div></div>');
    //     $(".unique-value").trigger('change');
    // }

    // function to add master div in add employee form
    function addMore(obj) {
        $("#masters").show();
        $("#addmore").hide();
    }
    // function to remove dynamic feilds
    // function remove() {
    //     $('.add-mr').html('+')
    //     $('.add-mr').attr("onclick", "addMore(this)")
    //     $(obj).parent().parent().remove()
    // }

    // function to remove master div in add employee form
    function remove() {
        $("#masters").hide();
        $("#addmore").show();
        $('.masters input,.masters select').val('');
    }

    // function displayCourse(length) {
    //     if (length == 0) {
    //         length = '';
    //     }
    //     if ($("#inputDegreetype" + length).val() == "Graduation") {
    //         $("#course" + length).show();
    //         $("#course" + length).html(' <option selected value="">Choose...</option><option value="b_tech">B.tech</option><option value="bca">BCA</option>');
    //     } else if ($("#inputDegreetype" + length).val() == "Masters") {
    //         $("#course" + length).show();
    //         $("#course" + length).html(' <option selected value="">Choose...</option><option value="m_tech">M.tech</option><option value="mca">MCA</option>');
    //     } else {
    //         $("#course" + length).hide();
    //         $("#course" + length).html('');
    //     } 
    // }

    // function to fetch state and city list  
    function getCityLIstFromStateId(obj) {
        var state_id = $(obj).val();
        var data = {
            state_id: state_id
        };
        $.ajax({
            type: "GET",
            url: "{{action('AdminController@getCityList')}}",
            data: data,
            cache: false,
            success: function(response) {
                $(obj).parent().next().find('.city').html(response.cities_list);
            }
        });
    }

    // function to check if personal email exits
    function checkperemail(obj) {
        var peremail = $(obj).val();
        var token = '{{csrf_token()}}';
        var data =
            $.ajax({
                url: '{{route("peremail-post")}}',
                method: "POST",
                dataType: "json",
                data: {
                    peremail: peremail,
                    '_token': token
                },
                cache: false,
                success: function(response) {
                    if (response.status == '500') {
                        $('.chkeml').html('Already Exist');
                        $(':input[type="submit"]').prop('disabled', true);
                    } else {
                        $('.chkeml').html('');
                        $(':input[type="submit"]').prop('disabled', false);
                    }
                }
            });
    }

    // function to check if company email exits
    function checkemail(obj) {
        var email = $(obj).val();
        var token = '{{csrf_token()}}';
        var data =
            $.ajax({
                url: '{{route("email-post")}}',
                method: "POST",
                dataType: "json",
                data: {
                    email: email,
                    '_token': token
                },
                cache: false,
                success: function(response) {
                    if (response.status == '500') {
                        $('.eml').html('Not Available');
                        $(':input[type="submit"]').prop('disabled', true);
                    } else {
                        $('.eml').html('');
                        $(':input[type="submit"]').prop('disabled', false);
                    }
                }
            });
    }

    // $(document).ready(function() {
    //     $(".unique-value").change(function() {
    //         // Get the selected value
    //         var selected = $("option:selected", $(this)).val();
    //         // Get the ID of this element
    //         var thisID = $(this).prop("id");
    //         // Reset so all values are showing:
    //         $(".unique-value option").each(function() {
    //             $(this).prop("disabled", false);
    //         });
    //         $(".unique-value").each(function() {
    //             if ($(this).prop("id") != thisID) {
    //                 $("option[value='" + selected + "']", $(this)).prop("disabled", true);
    //             }
    //         });

    //     });
    // });

    // function to make tables flex
    $(document).ready(function() {
        // inspired by http://jsfiddle.net/arunpjohny/564Lxosz/1/
        $('.table-responsive-stack').each(function(i) {
            var id = $(this).attr('id');
            //alert(id);
            $(this).find("th").each(function(i) {
                $('#' + id + ' td:nth-child(' + (i + 1) + ')').prepend('<span class="table-responsive-stack-thead">' + $(this).text() + ':</span>');
                $('.table-responsive-stack-thead').hide();
            });
        });
        $('.table-responsive-stack').each(function() {
            var thCount = $(this).find("th").length;
            var rowGrow = 100 / thCount + '%';
            //console.log(rowGrow);
            $(this).find("th, td").css('flex-basis', rowGrow);
        });

        function flexTable() {
            if ($(window).width() < 768) {
                $(".table-responsive-stack").each(function(i) {
                    $(this).find(".table-responsive-stack-thead").show();
                    $(this).find('thead').hide();
                });
                // window is less than 768px   
            } else {
                $(".table-responsive-stack").each(function(i) {
                    $(this).find(".table-responsive-stack-thead").hide();
                    $(this).find('thead').show();
                });
            }
            // flextable   
        }
        flexTable();
        window.onresize = function(event) {
            flexTable();
        };
        // document ready  
    });
    //   intilize
    $(document).ready(function() {
        $('.datatable').DataTable();
    });

    function stopedit() {
        $('.edit input,.edit select').prop('disabled', true);
        $('.edit button').hide();
    }

    window.onload = stopedit();

    function editprofile() {
        $('.edit input,.edit select').prop('disabled', false);
        $('.edit button').show();
        $('#editbutton').hide();
    }

    function canceledit(){
        window.location.reload()
    }
</script>