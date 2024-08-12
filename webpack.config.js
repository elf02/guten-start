const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');
const { globSync } = require('glob');
const RemoveEmptyScriptsPlugin = require('webpack-remove-empty-scripts');
const CopyPlugin = require('copy-webpack-plugin');

const blockStylesheets = () => globSync('./resources/scss/blocks/*.scss').reduce((files, filepath) => {
    const name = path.parse(filepath).name;

    files[`css/blocks/${name}`] = path.resolve(
        process.cwd(),
        'resources/scss/blocks',
        `${name}.scss`
    );

    return files;
}, {});

module.exports = {
    ...defaultConfig,
    ...{
        entry: {
            ...defaultConfig.entry(),
            ...blockStylesheets(),
            'css/screen': path.resolve(process.cwd(), 'resources/scss', 'screen.scss'),
            'css/editor': path.resolve(process.cwd(), 'resources/scss', 'editor.scss'),
            'js/screen': path.resolve(process.cwd(), 'resources/js', 'screen.js'),
            'js/editor': path.resolve(process.cwd(), 'resources/js', 'editor.js')
        },
        plugins: [
            ...defaultConfig.plugins,

            new RemoveEmptyScriptsPlugin({
                stage: RemoveEmptyScriptsPlugin.STAGE_AFTER_PROCESS_PLUGINS
            }),

            new CopyPlugin({
                patterns: [
                    {
                        from: './resources/fonts',
                        to: './fonts',
                        noErrorOnMissing: true
                    },
                    {
                        from: './resources/media',
                        to: './media',
                        noErrorOnMissing: true
                    }
                ]
            })
        ]
    }
};