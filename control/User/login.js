$(document).ready(function() {
	const Toast = Swal.mixin({
		toast : true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 2000,
		timeProgressBar: true,
		dismiss: Swal.DismissReason.timer,
		onOpen: (toast) => {
			toast.addEventListener('mouseenter', Swal.stopTimer)
			toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
	})

	Toast.fire({
		icon: 'success',
		title: 'Berhasil Login' 
	})
	
})

	
	
