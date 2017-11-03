var bridge = function (leafPath) {
    window.rhubarb.viewBridgeClasses.TextBoxViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.TextBoxViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.getStandardValidator = function (targetElement) {
    var securePasswordValidator = new window.rhubarb.validation.validator();
    securePasswordValidator
        .require()
        .setTargetElement(targetElement)
        .setSource(new window.rhubarb.validation.sources.fromViewBridge(this))
        .addTrigger(new window.rhubarb.validation.triggers.onViewBridgeValueChanged(this))
        .check(this.isSecurePassword);

    return securePasswordValidator;
};

bridge.prototype.isSecurePassword = function () {
    return function (value, successCallback, failureCallback) {
        var validationErrors = [];
        if (this.model.minimumLength > 0) {
            if (value.length < this.model.minimumLength) {
                validationErrors.push(this.model.validationErrorMessages[this.model.MINIMUM_LENGTH_KEY]);
            }
        }

        if (this.model.maximumLength > 0) {
            if (value.length > this.model.maximumLength) {
                validationErrors.push(this.model.validationErrorMessages[this.model.MAXIMUM_LENGTH_KEY]);
            }
        }

        if (this.model.minimumRequiredNumbers > 0) {
            var matches = this.getRegexMatches(/[0-9]/g, value);

            if (matches.length < this.model.minimumRequiredNumbers) {
                validationErrors.push(this.model.validationErrorMessages[this.model.MINIMUM_REQUIRED_NUMBERS_KEY]);
            }
        }

        if (this.model.minimumRequiredUppercaseLetters > 0) {
            var matches = this.getRegexMatches(/[A-Z]/g, value);
            if (matches.length < this.model.minimumRequiredUppercaseLetters) {
                validationErrors.push(this.model.validationErrorMessages[this.model.MINIMUM_REQUIRED_UPPERCASE_LETTERS_KEY]);
            }
        }

        if (this.model.minimumRequiredLowercaseLetters > 0) {
            var matches = this.getRegexMatches(/[a-z]/g, value);
            if (matches.length < this.model.minimumRequiredLowercaseLetters) {
                validationErrors.push(this.model.validationErrorMessages[this.model.MINIMUM_REQUIRED_LOWERCASE_LETTERS_KEY]);
            }
        }

        if (this.model.minimumRequiredSpecialCharacters > 0) {
            var matches = this.getRegexMatches(/[(!@#$%^&*).]/g, value);
            if (matches.length < this.model.minimumRequiredSpecialCharacters) {
                validationErrors.push(this.model.validationErrorMessages[this.model.MINIMUM_REQUIRED_SPECIAL_CHARACTERS_LETTERS_KEY]);
            }
        }

        if (this.model.minimumZxcvbnOverallScore > 0) {
            // var matches = this.getRegexMatches(/[(!@#$%^&*).]/g, value);
            var result = zxcvbn(value);
            if (result.score < this.model.minimumZxcvbnOverallScore) {
                validationErrors.push(this.model.validationErrorMessages[this.model.MINIMUM_ZXCVBN_OVERALL_SCORE_KEY]);
            }
        }

        if (validationErrors.length > 0) {
            failureCallback(validationErrors);
        } else {
            successCallback();
        }
    }
};

bridge.prototype.getRegexMatches = function (regex, valueToCheck) {
    var matches = [],
        match;

    while ((match = regex.exec(valueToCheck)) !== null) {
        matches.push(match[0]);
    }

    return matches;
};


window.rhubarb.viewBridgeClasses.ZxcvbnPasswordTextBoxViewBridge = bridge;
