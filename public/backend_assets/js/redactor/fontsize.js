if (!RedactorPlugins) var RedactorPlugins = {};

(function($)
{
	RedactorPlugins.fontsize = function()
	{
		return {
			init: function()
			{
				var fonts = [10, 11, 12, 14, 16, 18, 20, 24, 28, 30];
				var that = this;
				var dropdown = {};

				$.each(fonts, function(i, s)
				{
					dropdown['s' + i] = { title: s + 'px', func: function() { that.fontsize.set(s); } };
				});

				dropdown.remove = { title: '移除字體大小', func: that.fontsize.reset };

				var button = this.button.add('fontsize', '更改字體大小');
				this.button.addDropdown(button, dropdown);
			},
			set: function(size)
			{
				this.inline.format('span', 'style', 'font-size: ' + size + 'px;');
			},
			reset: function()
			{
				this.inline.removeStyleRule('font-size');
			}
		};
	};
})(jQuery);