function addUrlParameter(name, value) {
    var searchParams = new URLSearchParams(window.location.search);
    searchParams.set(name, value);
    return '?'+searchParams.toString();
}

function gen_pagination(total, limit, round) {
    var cnt_round = Math.ceil(total / limit);
	if (cnt_round > 0 && round != 1){
		let prev_round = (round * 1) - 1;
		$("#prev_round").removeClass("disabled");
		$("#prev_round").children().prop('href', addUrlParameter("round", prev_round));
	}
	if (cnt_round > 0 && cnt_round != round){
		let next_round = (round * 1) +1;
		$("#next_round").removeClass("disabled");
		$("#next_round").children().prop('href', addUrlParameter("round", next_round));
	}
	var round_list = '';
	for (var i = 1; i < (cnt_round + 1); i++) {
		var active = '';
		if (i == round){
			active = 'active';
		}
		round_list += `<li class="page-item `+ active +`">
						 <a class="page-link" href="`+ addUrlParameter("round", i) +`">` + i + `</a>
					   </li>`;
	}
	$("#prev_round").after(round_list);
}