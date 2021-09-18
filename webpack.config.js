const path = require('path');

module.exports = {
    resolve: {
        extensions: ['.tsx'],
        alias: {
            '@': path.resolve('resources/js'),
            '@mui/meterial': path.resolve('node_modules/@material-ui/core'),
            '@material-ui/icons': path.resolve('node_modules/@material-ui/icons')
        },
    },
};