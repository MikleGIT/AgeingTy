if (!RedactorPlugins) var RedactorPlugins = {};
 
RedactorPlugins.bufferbuttons = function()
{
    return {
        init: function()
        {
            var undo = this.button.addFirst('undo', '還原');
            var redo = this.button.addAfter('undo', 'redo', '重做');
 
            this.button.addCallback(undo, this.buffer.undo);
            this.button.addCallback(redo, this.buffer.redo);
        }
    };
};