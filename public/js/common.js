let slideUp = (target, duration=500) => {

	target.style.transitionProperty = 'height, margin, padding';
	target.style.transitionDuration = duration + 'ms';
	target.style.boxSizing = 'border-box';
	target.style.height = target.offsetHeight + 'px';
	target.offsetHeight;
	target.style.overflow = 'hidden';
	target.style.height = 0;
	target.style.paddingTop = 0;
	target.style.paddingBottom = 0;
	target.style.marginTop = 0;
	target.style.marginBottom = 0;
	window.setTimeout( () => {
				target.style.display = 'none';
				target.style.removeProperty('height');
				target.style.removeProperty('padding-top');
				target.style.removeProperty('padding-bottom');
				target.style.removeProperty('margin-top');
				target.style.removeProperty('margin-bottom');
				target.style.removeProperty('overflow');
				target.style.removeProperty('transition-duration');
				target.style.removeProperty('transition-property');
				//alert("!");
	}, duration);
}

/* SLIDE DOWN */
let slideDown = (target, duration=500) => {

	target.style.removeProperty('display');
	let display = window.getComputedStyle(target).display;
	if (display === 'none') display = 'block';
	target.style.display = display;
	let height = target.offsetHeight;
	target.style.overflow = 'hidden';
	target.style.height = 0;
	target.style.paddingTop = 0;
	target.style.paddingBottom = 0;
	target.style.marginTop = 0;
	target.style.marginBottom = 0;
	target.offsetHeight;
	target.style.boxSizing = 'border-box';
	target.style.transitionProperty = "height, margin, padding";
	target.style.transitionDuration = duration + 'ms';
	target.style.height = height + 'px';
	target.style.removeProperty('padding-top');
	target.style.removeProperty('padding-bottom');
	target.style.removeProperty('margin-top');
	target.style.removeProperty('margin-bottom');
	window.setTimeout( () => {
		target.style.removeProperty('height');
		target.style.removeProperty('overflow');
		target.style.removeProperty('transition-duration');
		target.style.removeProperty('transition-property');
	}, duration);
}

/* TOOGLE */
let slideToggle = (target, duration = 500) => {
	if (window.getComputedStyle(target).display === 'none') {
		return slideDown(target, duration);
	} else {
		return slideUp(target, duration);
	}
}
//Top Header - menu
document.getElementById('topNmvBtn').addEventListener('click', function(event){
	let btn = event.target;
	const topNav = document.querySelector('.top_nav');

	console.log('Click');

	if(btn.classList.contains('closed')){
		btn.classList.remove('closed')
		btn.classList.add('open')
		slideDown(topNav, 500);

		return false;
	}
	if(btn.classList.contains('open')){
		btn.classList.remove('open')
		btn.classList.add('closed')
		if(topNav.style.display=='block') topNav.style.display = 'none';

	}
});
//Форма поиска на мобильных устройствах
document.getElementById('searchBtn').addEventListener('click', function(event){
	const searchBtnClosed = document.getElementById('searchBtnClosed');
	const searchForm = document.getElementById('searchForm');
	searchBtnClosed.addEventListener('click', function(){
		if(searchForm.classList.contains('open')){
			searchForm.classList.remove('open');
		}
	});
	if(!searchForm.classList.contains('open')){
		searchForm.classList.add('open');
		return false;
	}
	if(searchForm.classList.contains('open')){
		searchForm.classList.remove('open');
	}
});

//*--- Counter for products list  ---*//
const counter = function () {
	const btns = document.querySelectorAll('.item_counter__btn');
	btns.forEach(btn => {
		btn.addEventListener('click', function () {
			const direction = this.dataset.direction;
			const inp = this.parentElement.querySelector('.item_counter__value');
			const currentValue = +inp.value;
			let newValue;
			if (direction === 'plus') {
				newValue = currentValue + 1;
			} else {
				newValue = currentValue - 1 > 1 ? currentValue - 1 : 1;
			}
			if(typeof newValue !== NaN){
				inp.value =  newValue;
			} else {
				inp.value =  1;
			}
		})
	})
}
counter();

//*---  show list prodacts  ---*//
const showCatalog = function(element){
	if(element.classList.contains('active')) return false;
	const type = element.dataset.type;
	const itemsBlock = document.getElementById('itemsBlock');
	document.querySelectorAll('.sort_btn').forEach(elem => {
		if(elem.classList.contains('active')) elem.classList.remove('active');
	});
	element.classList.add('active');
	if( type === 'list' || !itemsBlock.classList.contains('list')){
		itemsBlock.classList.add('list')
	} else {
		itemsBlock.classList.remove('list')
	}
}

document.querySelectorAll('.filitr_type_name').forEach(elem=>{
	elem.addEventListener('click', function(){
		let filterBlock = elem.parentElement;
		filterBlock.classList.toggle('active');


	})
});

/** -- Price filter-- */

if(document.getElementById('priceRange')){
	let priceRange = document.getElementById('priceRange');
	const input0 = document.getElementById('input-0');
	const input1 = document.getElementById('input-1');
	const inputs = [input0, input1];

	let priceMin = Number(input0.getAttribute('min'));
	let priceMax = Number(input0.getAttribute('max'));
	noUiSlider.create(priceRange, {


		start: [priceMin, priceMax],
		connect: true,
		priceMin,
		range: {
			'min': priceMin,
			'max': priceMax
		}
	});

	priceRange.noUiSlider.on('update', function(values, handle){
		inputs[handle].value = Math.round(values[handle]);
	});

	const setRangeSlider = (i, value) => {
		let arr = [null, null];
		arr[i] = value;
		priceRange.noUiSlider.set(arr);
	};
	inputs.forEach((el, index) => {
		el.addEventListener('change', (e) => {
			setRangeSlider(index, e.currentTarget.value);
		});
	});


}

if(document.getElementById('filterUp')){
	document.getElementById('filterUp').addEventListener('click', function(event){
		const filterUp = event.currentTarget;
		filterUp.classList.toggle('up');
		const filterInner = document.getElementById('filterInner');
		filterInner.classList.toggle('show');
	});
}

if(document.getElementById('cosialIcons')){
	document.querySelectorAll('.footer_icon').forEach(elem=>{
		elem.addEventListener('click', function(event){
			let btn = event.currentTarget;
			let url =  btn.dataset.link;
			if(url){
				if ((url).substr(0, 'https://'.length) !== 'https://') url = 'https://' + url;
				window.open(url, '_blank');
			}
		});
	});
}


const banners = new Swiper('#banners', {
  speed: 5000,
	loop: true,
	effect: "fade",
	fadeEffect: {
		crossFade: true
	},
	autoplay: {
		delay: 10000,
		disableOnInteraction: false,
		pauseOnMouseEnter: true,
	},

});



// Product images gallery
if(document.getElementById('productImg')){
	let productImg = document.getElementById('productImg');
	document.querySelectorAll('.product_img_prev_link').forEach(function(elem){
			elem.addEventListener('click', function(link){
					link.preventDefault();
					link = link.currentTarget;
					let href = link.getAttribute('href');
					productImg.setAttribute('src', href);
			});
	});
	productImg.addEventListener('click', function (item) {
			item.preventDefault();
			let mainImgLink = productImg.getAttribute('src');
			let gallery = [];
			let imgNamber = 0;
			//let title = '';

			document.querySelectorAll('.product_img_prev_link').forEach(function(elem, i, ArrLinks){
					let link = elem.getAttribute('href');
					if(mainImgLink == link) imgNamber = i;
					let objFancyBox = {
							src: link,
							type: 'image',
							caption: 'Примеры работы печника',
					}
					gallery.push(objFancyBox);
			});
			new Fancybox(gallery);
			Fancybox.getInstance().jumpTo(imgNamber);
	});
}

Fancybox.bind('[data-fancybox]', {
	// Custom options for all galleries
});

/*   --------------------------------------------------------------*/
/*  Функция для прокрутки с контролем скорости
/*  --------------------------------------------------------------*/
function scrollToUp(to, duration = 700) {
	const
			element = document.scrollingElement || document.documentElement,
			start = element.scrollTop,
			change = to - start,
			startDate = +new Date(),
			// t = current time
			// b = start value
			// c = change in value
			// d = duration
			easeInOutQuad = function (t, b, c, d) {
					t /= d / 2;
					if (t < 1) return c / 2 * t * t + b;
					t--;
					return -c / 2 * (t * (t - 2) - 1) + b;
			},
			animateScroll = function () {
					const currentDate = +new Date();
					const currentTime = currentDate - startDate;
					element.scrollTop = parseInt(easeInOutQuad(currentTime, start, change, duration));
					if (currentTime < duration) {
							requestAnimationFrame(animateScroll);
					}
					else {
							element.scrollTop = to;
					}
			};
	animateScroll();
}

document.addEventListener('DOMContentLoaded', function () {

	document.addEventListener("scroll", (event) => {
		let btn = document.querySelector('#upbutton');
		let total = document.documentElement.scrollHeight;
		let current = window.pageYOffset;

		if(total > window.innerHeight){
			if(current > (total*0.6)){
				btn.classList.add('show');
			}else{
				if(btn.classList.contains('show')) btn.classList.remove('show');
			}
		}

		btn.onclick = function (click) {
				click.preventDefault();
				scrollToUp(0, 500);
		}

	});

});


