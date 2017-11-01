var bridge = function (leafPath) {
  window.rhubarb.viewBridgeClasses.TextBoxViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.TextBoxViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.onKeyUp = function (event) {
    // console.log('On Key Up Detected');
};

window.rhubarb.viewBridgeClasses.ZxcvbnPasswordTextBoxViewBridge = bridge;
