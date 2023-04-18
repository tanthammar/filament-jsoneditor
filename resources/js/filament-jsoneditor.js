import JSONEditor from './jsoneditor.min.js';
import './jsoneditor.min.css';

export default FilamentJsoneditor(config)
{
    return {
        state: config.state,
        isJson: config.isJson,
        modes: config.modes,
        get formattedState() {
            return this.isJson ? this.state : JSON.parse(this.state)
        },
        init() {
            this.$nextTick(() => {
                const options = {
                    modes: this.modes,
                    history: true,
                    onChange: function () {
                    },
                    onChangeJSON: function (json) {
                        state = JSON.stringify(json);
                    },
                    onChangeText: function (jsonString) {
                        state = jsonString;
                    },
                    onValidationError: function (errors) {
                        errors.forEach((error) => {
                            switch (error.type) {
                                case 'validation': // schema validation error
                                    break;
                                case 'error':  // json parse error
                                    console.log(error.message);
                                    break;
                            }
                        })
                    }
                };
                if (typeof json_editor !== 'undefined') {
                    json_editor = new JSONEditor($refs.editor, options);
                    json_editor.set(formattedState);
                } else {
                    let json_editor = new JSONEditor($refs.editor, options);
                    json_editor.set(formattedState);
                }
            })
        }
    }
}
