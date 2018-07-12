module.exports = function (processor) {
  processor.registerBlockType('embed_scripts', function (content, block, blockLine, blockContent) {
    var js_libs_import = require('../settings/js_libs.json'),
        js_libs = js_libs_import.js_libs,
        js_main = js_libs_import.script,
        embed = "";

    for (let index = 0; index < js_libs.length; index++) {
        embed += '<script src="' + js_libs[index] +'"></script>\n';
    }
    for (let index = 0; index < js_main.length; index++) {
        embed += '<script src="' + js_main[index] +'"></script>\n';
    }
    var result = content.replace(blockLine, embed);
    return result;
  });
};