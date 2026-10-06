/**
 * Interactive Dental Odontogram Component
 * Provides SVG-based tooth chart with click interactions
 */

let odontogramData = {};
let selectedTooth = null;
let selectedTeeth = []; // For multiple tooth selection
let multiSelectMode = false;

// Tooth numbering system (FDI)
const toothNumbers = {
    upperRight: ['18', '17', '16', '15', '14', '13', '12', '11'],
    upperLeft: ['21', '22', '23', '24', '25', '26', '27', '28'],
    lowerLeft: ['31', '32', '33', '34', '35', '36', '37', '38'],
    lowerRight: ['48', '47', '46', '45', '44', '43', '42', '41']
};

// Condition colors
const conditionColors = {
    'healthy': '#FFFFFF',
    'caries': '#FF0000',
    'filled': '#0000FF',
    'crowned': '#FFD700',
    'extracted': '#000000',
    'impacted': '#800080',
    'fractured': '#FF6600',
    'root_canal': '#FF69B4',
    'implant': '#00FF00',
    'bridge': '#00FFFF',
    'other': '#808080'
};

function initializeOdontogram() {
    createOdontogramSVG();
    bindToothEvents();
}

function createOdontogramSVG() {
    const container = document.getElementById('odontogramContainer');
    if (!container) return;

    const svg = `
        <svg width="100%" height="400" viewBox="0 0 800 400" style="border: 2px solid #ddd; border-radius: 8px; background: #f8f9fa;">
            <!-- Upper Jaw -->
            <g id="upperJaw">
                <!-- Upper Right Quadrant -->
                <g id="upperRight" transform="translate(50, 50)">
                    ${createQuadrant(toothNumbers.upperRight, 'upperRight', 0)}
                </g>
                <!-- Upper Left Quadrant -->
                <g id="upperLeft" transform="translate(450, 50)">
                    ${createQuadrant(toothNumbers.upperLeft, 'upperLeft', 0)}
                </g>
            </g>
            
            <!-- Center Line -->
            <line x1="400" y1="40" x2="400" y2="360" stroke="#666" stroke-width="2" stroke-dasharray="5,5"/>
            
            <!-- Lower Jaw -->
            <g id="lowerJaw">
                <!-- Lower Left Quadrant -->
                <g id="lowerLeft" transform="translate(450, 250)">
                    ${createQuadrant(toothNumbers.lowerLeft, 'lowerLeft', 0)}
                </g>
                <!-- Lower Right Quadrant -->
                <g id="lowerRight" transform="translate(50, 250)">
                    ${createQuadrant(toothNumbers.lowerRight, 'lowerRight', 0)}
                </g>
            </g>
            
            <!-- Labels -->
            <text x="200" y="30" text-anchor="middle" font-family="Arial" font-size="14" font-weight="bold" fill="#666">Upper Right</text>
            <text x="600" y="30" text-anchor="middle" font-family="Arial" font-size="14" font-weight="bold" fill="#666">Upper Left</text>
            <text x="600" y="390" text-anchor="middle" font-family="Arial" font-size="14" font-weight="bold" fill="#666">Lower Left</text>
            <text x="200" y="390" text-anchor="middle" font-family="Arial" font-size="14" font-weight="bold" fill="#666">Lower Right</text>
        </svg>
    `;
    
    container.innerHTML = svg;
}

function createQuadrant(teeth, quadrant, rotation) {
    let quadrantSVG = '';
    
    teeth.forEach((toothNumber, index) => {
        const x = index * 40;
        const y = 0;
        
        quadrantSVG += `
            <g class="tooth-group" data-tooth="${toothNumber}">
                <rect x="${x}" y="${y}" width="35" height="45" 
                      fill="${conditionColors.healthy}" 
                      stroke="#333" stroke-width="2" 
                      rx="5" ry="5" 
                      class="tooth-rect" 
                      style="cursor: pointer; transition: all 0.3s ease;"
                      onmouseover="this.style.strokeWidth='3'; this.style.stroke='#007bff';"
                      onmouseout="this.style.strokeWidth='2'; this.style.stroke='#333';"
                      onclick="selectTooth('${toothNumber}', event.ctrlKey || event.metaKey)"/>
                <text x="${x + 17.5}" y="${y + 25}" text-anchor="middle" 
                      font-family="Arial" font-size="10" font-weight="bold" 
                      fill="#000" pointer-events="none">${toothNumber}</text>
                <!-- Status indicator -->
                <circle cx="${x + 30}" cy="${y + 5}" r="3" 
                        fill="transparent" stroke="transparent" 
                        class="tooth-status" id="status-${toothNumber}"/>
            </g>
        `;
    });
    
    return quadrantSVG;
}

function selectTooth(toothNumber, ctrlKey = false) {
    if (multiSelectMode || ctrlKey) {
        // Multi-select mode
        if (selectedTeeth.includes(toothNumber)) {
            // Deselect tooth
            selectedTeeth = selectedTeeth.filter(t => t !== toothNumber);
            updateToothSelection(toothNumber, false);
        } else {
            // Select tooth
            selectedTeeth.push(toothNumber);
            updateToothSelection(toothNumber, true);
        }
        
        if (selectedTeeth.length > 0) {
            // Update modal for multiple teeth
            document.getElementById('selectedToothNumber').textContent = 
                selectedTeeth.length === 1 ? selectedTeeth[0] : `${selectedTeeth.length} teeth selected`;
            document.getElementById('toothNumber').value = selectedTeeth.join(',');
            
            // Reset form for bulk editing
            document.getElementById('toothForm').reset();
            document.getElementById('toothNumber').value = selectedTeeth.join(',');
            document.getElementById('toothType').value = 'permanent';
            document.getElementById('toothCondition').value = 'healthy';
            
            // Show multi-select info
            const multiSelectInfo = document.getElementById('multiSelectInfo');
            if (multiSelectInfo && selectedTeeth.length > 1) {
                multiSelectInfo.style.display = 'block';
            }
            
            // Show modal
            $('#toothModal').modal('show');
        }
    } else {
        // Single select mode
        selectedTooth = toothNumber;
        selectedTeeth = [toothNumber];
        
        // Clear previous selections
        document.querySelectorAll('.tooth-rect').forEach(rect => {
            rect.style.stroke = '#333';
            rect.style.strokeWidth = '2';
        });
        
        // Highlight selected tooth
        updateToothSelection(toothNumber, true);
        
        // Update modal title
        document.getElementById('selectedToothNumber').textContent = toothNumber;
        document.getElementById('toothNumber').value = toothNumber;
        
        // Load existing data if available
        if (odontogramData[toothNumber]) {
            const data = odontogramData[toothNumber];
            document.getElementById('toothType').value = data.tooth_type || 'permanent';
            document.getElementById('toothCondition').value = data.condition || 'healthy';
            document.getElementById('surfaceAffected').value = data.surface_affected || '';
            document.getElementById('toothSeverity').value = data.severity || '';
            document.getElementById('toothNotes').value = data.notes || '';
        } else {
            // Reset form
            document.getElementById('toothForm').reset();
            document.getElementById('toothNumber').value = toothNumber;
            document.getElementById('toothType').value = 'permanent';
            document.getElementById('toothCondition').value = 'healthy';
        }
        
        // Hide multi-select info for single selection
        const multiSelectInfo = document.getElementById('multiSelectInfo');
        if (multiSelectInfo) {
            multiSelectInfo.style.display = 'none';
        }
        
        // Show modal
        $('#toothModal').modal('show');
    }
}

function updateToothSelection(toothNumber, selected) {
    const toothRect = document.querySelector(`[data-tooth="${toothNumber}"] .tooth-rect`);
    if (toothRect) {
        if (selected) {
            toothRect.style.stroke = '#007bff';
            toothRect.style.strokeWidth = '3';
        } else {
            toothRect.style.stroke = '#333';
            toothRect.style.strokeWidth = '2';
        }
    }
}

function bindToothEvents() {
    // Save tooth data
    document.getElementById('saveToothData').addEventListener('click', function() {
        const toothNumbers = document.getElementById('toothNumber').value.split(',');
        const toothType = document.getElementById('toothType').value;
        const condition = document.getElementById('toothCondition').value;
        const surfaceAffected = document.getElementById('surfaceAffected').value;
        const severity = document.getElementById('toothSeverity').value;
        const notes = document.getElementById('toothNotes').value;
        
        // Store data for all selected teeth
        toothNumbers.forEach(toothNumber => {
            toothNumber = toothNumber.trim();
            if (toothNumber) {
                odontogramData[toothNumber] = {
                    tooth_type: toothType,
                    condition: condition,
                    surface_affected: surfaceAffected,
                    severity: severity,
                    notes: notes,
                    color_code: conditionColors[condition] || conditionColors.healthy
                };
                
                // Update visual representation
                updateToothVisual(toothNumber, condition);
            }
        });
        
        // Clear selections
        selectedTeeth = [];
        selectedTooth = null;
        document.querySelectorAll('.tooth-rect').forEach(rect => {
            rect.style.stroke = '#333';
            rect.style.strokeWidth = '2';
        });
        
        // Close modal
        $('#toothModal').modal('hide');
        
        // Show success message
        const message = toothNumbers.length > 1 ? 
            `${toothNumbers.length} teeth updated successfully` : 
            'Tooth data updated successfully';
        showToast(message, 'success');
    });
    
    // Reset odontogram
    document.getElementById('resetOdontogram').addEventListener('click', function() {
        if (confirm('Are you sure you want to reset all tooth data?')) {
            resetOdontogram();
            showToast('Odontogram reset successfully', 'info');
        }
    });
    
    // Toggle multi-select mode
    document.getElementById('toggleMultiSelect').addEventListener('click', function() {
        multiSelectMode = !multiSelectMode;
        const btn = this;
        if (multiSelectMode) {
            btn.classList.remove('btn-info');
            btn.classList.add('btn-warning');
            btn.innerHTML = '<i class="fas fa-check-square mr-1"></i>Multi-Select ON';
            showToast('Multi-select mode enabled. Click teeth to select multiple or use Ctrl+Click', 'info');
        } else {
            btn.classList.remove('btn-warning');
            btn.classList.add('btn-info');
            btn.innerHTML = '<i class="fas fa-mouse-pointer mr-1"></i>Multi-Select';
            // Clear selections
            selectedTeeth = [];
            selectedTooth = null;
            document.querySelectorAll('.tooth-rect').forEach(rect => {
                rect.style.stroke = '#333';
                rect.style.strokeWidth = '2';
            });
            showToast('Multi-select mode disabled', 'info');
        }
    });
}

function updateToothVisual(toothNumber, condition) {
    const toothRect = document.querySelector(`[data-tooth="${toothNumber}"] .tooth-rect`);
    const statusIndicator = document.getElementById(`status-${toothNumber}`);
    
    if (toothRect) {
        const color = conditionColors[condition] || conditionColors.healthy;
        toothRect.setAttribute('fill', color);
        
        // Update status indicator
        if (statusIndicator) {
            if (condition !== 'healthy') {
                statusIndicator.setAttribute('fill', '#ff4444');
                statusIndicator.setAttribute('stroke', '#cc0000');
            } else {
                statusIndicator.setAttribute('fill', 'transparent');
                statusIndicator.setAttribute('stroke', 'transparent');
            }
        }
        
        // Add animation
        toothRect.style.transform = 'scale(1.1)';
        setTimeout(() => {
            toothRect.style.transform = 'scale(1)';
        }, 200);
    }
}

function resetOdontogram() {
    odontogramData = {};
    
    // Reset all tooth visuals
    document.querySelectorAll('.tooth-rect').forEach(rect => {
        rect.setAttribute('fill', conditionColors.healthy);
    });
    
    document.querySelectorAll('.tooth-status').forEach(status => {
        status.setAttribute('fill', 'transparent');
        status.setAttribute('stroke', 'transparent');
    });
}

function getOdontogramData() {
    return odontogramData;
}

function loadOdontogramData(data) {
    odontogramData = data || {};
    
    // Update visuals for loaded data
    Object.keys(odontogramData).forEach(toothNumber => {
        const toothData = odontogramData[toothNumber];
        updateToothVisual(toothNumber, toothData.condition);
    });
}

function showToast(message, type = 'info') {
    // Create toast notification
    const toast = document.createElement('div');
    toast.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    toast.innerHTML = `
        ${message}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    `;
    
    document.body.appendChild(toast);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        if (toast.parentNode) {
            toast.parentNode.removeChild(toast);
        }
    }, 3000);
}

// Export functions for global use
window.initializeOdontogram = initializeOdontogram;
window.selectTooth = selectTooth;
window.getOdontogramData = getOdontogramData;
window.loadOdontogramData = loadOdontogramData;
window.resetOdontogram = resetOdontogram;
