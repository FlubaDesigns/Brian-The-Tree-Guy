// JavaScript Document

const a = new ImgPreviewer('body', {
				scrollbar: true
			})
			function add() {
				let img = document.createElement('img')
				img.src = `https://picsum.photos/500/500?random=${Math.random()}`
				img.onload = function () {
					document.getElementById('app').appendChild(img)
					a.update()
				}
			}
			document.getElementById('add').onclick = add