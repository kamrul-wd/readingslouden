var deleter = {

	linkSelector: "a[data-delete]",
	modalTitle: "Are you sure?",
	modalMessage: "This will delete the item.",
	modalConfirmButtonText: "Yes, delete it!",
	csrfToken: null,
	url: "/",

	init: function() {
		$(this.linkSelector).on('click', {
			self: this
		}, this.handleClick);
	},

	handleClick: function(event) {
		event.preventDefault();

		var self = event.data.self;
		var link = $(this);

		self.modalTitle = link.data('title') || self.modalTitle;
		self.modalMessage = link.data('message') || self.modalMessage;
		self.modalConfirmButtonText = link.data('button-text') || self.modalConfirmButtonText;
		self.url = link.attr('href');
		self.csrfToken = $('meta[name=csrf-token]').attr('content');

		self.confirmAction();
	},

	confirmAction: function() {
		swal({
				title: this.modalTitle,
				text: this.modalMessage,
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#e74c3c",
				confirmButtonText: this.modalConfirmButtonText,
				closeOnConfirm: true,
				allowOutsideClick: true
			},
			function() {
				this.makeRequest()
			}.bind(this)
		);
	},

	makeRequest: function() {
		var form =
			$('<form>', {
				'method': 'POST',
				'action': this.url
			});

		var token =
			$('<input>', {
				'type': 'hidden',
				'name': '_token',
				'value': this.csrfToken
			});

		var hiddenInput =
			$('<input>', {
				'name': '_method',
				'type': 'hidden',
				'value': 'DELETE'
			});

		return form.append(token, hiddenInput).appendTo('body').submit();
	}
};

var copier = {

	linkSelector: "a[data-copy]",
	modalTitle: "Are you sure?",
	modalMessage: "This will copy the item.",
	modalConfirmButtonText: "Yes, copy it!",
	csrfToken: null,
	url: "/",

	init: function() {
		$(this.linkSelector).on('click', {
			self: this
		}, this.handleClick);
	},

	handleClick: function(event) {
		event.preventDefault();

		var self = event.data.self;
		var link = $(this);

		self.modalTitle = link.data('title') || self.modalTitle;
		self.modalMessage = link.data('message') || self.modalMessage;
		self.modalConfirmButtonText = link.data('button-text') || self.modalConfirmButtonText;
		self.url = link.attr('href');
		self.csrfToken = $('meta[name=csrf-token]').attr('content');

		self.confirmAction();
	},

	confirmAction: function() {
		swal({
				title: this.modalTitle,
				text: this.modalMessage,
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#5cb85c",
				confirmButtonText: this.modalConfirmButtonText,
				closeOnConfirm: true,
				allowOutsideClick: true
			},
			function() {
				this.makeRequest()
			}.bind(this)
		);
	},

	makeRequest: function() {
		var form =
			$('<form>', {
				'method': 'POST',
				'action': this.url
			});

		var token =
			$('<input>', {
				'type': 'hidden',
				'name': '_token',
				'value': this.csrfToken
			});

		return form.append(token).appendTo('body').submit();
	}
};

var confirm = {

	linkSelector: "a[data-confirm]",
	modalTitle: "Are you sure?",
	modalMessage: "Please confirm the action.",
	modalConfirmButtonText: "Yes, confirm!",
	url: "/",

	init: function() {
		$(this.linkSelector).on('click', {
			self: this
		}, this.handleClick);
	},

	handleClick: function(event) {
		event.preventDefault();

		var self = event.data.self;
		var link = $(this);

		self.modalTitle = link.data('title') || self.modalTitle;
		self.modalMessage = link.data('message') || self.modalMessage;
		self.modalConfirmButtonText = link.data('button-text') || self.modalConfirmButtonText;
		self.url = link.attr('href');

		self.confirmAction();
	},

	confirmAction: function() {
		swal({
                title: this.modalTitle,
                text: this.modalMessage,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#5cb85c",
                confirmButtonText: this.modalConfirmButtonText,
                closeOnConfirm: true,
                allowOutsideClick: true
			},
			function() {
                window.location.href = this.url;
			}.bind(this)
		);
	}
};

deleter.init();
copier.init();
confirm.init();