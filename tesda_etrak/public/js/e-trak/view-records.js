$(document).ready(function() {
    function fetchGraduates(page = 1, search = '') {
        $.ajax({
            url: "{{ route('') }}?page=" + page + "&search=" + search, 
            success: function(data) {
                $("#post-data").html(data.posts);
            }
        });

        $(document).on('keyup', '#search', function() {
            let search = $(this).val();
            fetchGraduates(1, search);
        });

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            let search = $("#search").val();
            fetchGraduates(page, search);
        });
    }
});