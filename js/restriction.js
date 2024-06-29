
        document.addEventListener('DOMContentLoaded', () => {
            const handleContextMenu = (e) => {
                e.preventDefault();
            };

            const handleKeyPress = (e) => {
                if (
                    (e.key === 'F12' && e.ctrlKey === false && e.shiftKey === false) ||
                    e.key === 'u' ||
                    (e.ctrlKey && e.shiftKey && e.key === 'J')
                ) {
                    e.preventDefault();
                }
            };

            const handleKeyDown = (e) => {
                if (e.ctrlKey && e.shiftKey && e.key === 'U') {
                    e.preventDefault();
                }
            };

            const handleMouseDown = (e) => {
                if (e.button === 2) {
                    e.preventDefault();
                }
            };

            document.addEventListener('contextmenu', handleContextMenu);
            document.addEventListener('keydown', handleKeyPress);
            document.addEventListener('keydown', handleKeyDown);
            document.addEventListener('mousedown', handleMouseDown);

            // Clean up event listeners when the page is unloaded
            window.addEventListener('unload', () => {
                document.removeEventListener('contextmenu', handleContextMenu);
                document.removeEventListener('keydown', handleKeyPress);
                document.removeEventListener('keydown', handleKeyDown);
                document.removeEventListener('mousedown', handleMouseDown);
            });
        });
