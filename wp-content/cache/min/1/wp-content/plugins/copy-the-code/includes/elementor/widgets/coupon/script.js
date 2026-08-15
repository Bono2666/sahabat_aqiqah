(function($){const CTCCoupon={init:function(){this._bind()},_bind:function(){$(document).on('click','.ctc-coupon-toggle-link',this.toggleDetails);$(document).on('click','.ctc-coupon-link',this.handleClick)},copyToClipboard:async function(text){if(window.CTC&&window.CTC.CopyEngine){try{const copyEngine=new window.CTC.CopyEngine();const result=await copyEngine.execute({value:text});if(result.success){return!0}}catch(err){}}
if(navigator.clipboard&&navigator.clipboard.writeText){try{await navigator.clipboard.writeText(text);return!0}catch(err){}}
try{const textArea=document.createElement('textarea');textArea.value=text;textArea.style.cssText='position:fixed;opacity:0;pointer-events:none;';document.body.appendChild(textArea);textArea.select();const success=document.execCommand('copy');document.body.removeChild(textArea);return success}catch(err){return!1}},handleClick:async function(event){event.preventDefault()
const self=$(this)
const parent=self.parents('.ctc-coupon')
if(parent.hasClass('ctc-coupon-clicked')){return}
const href=self.attr('href')
const target=self.attr('target')
const couponCode=parent.find('.ctc-coupon-code').text().trim()||''
parent.addClass('ctc-coupon-clicked')
await CTCCoupon.copyToClipboard(couponCode)
window.open(href,target)},oldHandleClick:function(event){event.preventDefault();const self=$(this)
const href=self.data('href')
const target=self.data('target')
const btn=self.find('.ctc-coupon-button')
if(!self.hasClass('ctc-coupon-link-clicked')){window.open(href,target)
self.addClass('ctc-coupon-link-clicked')
btn.text('Copy Code')}
if(self.hasClass('ctc-coupon-link-clicked')){self.addClass('ctc-coupon-link-copied')
btn.text('Copied')}},toggleDetails:function(event){event.preventDefault();const self=$(this)
const coupon=self.parents('.ctc-coupon')
const details=coupon.find('.ctc-toggle-details')
details.slideToggle('fast')}};$(function(){CTCCoupon.init()})})(jQuery)